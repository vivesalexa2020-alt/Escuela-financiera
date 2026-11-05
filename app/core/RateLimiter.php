<?php
namespace App\Core;

use PDO;
use App\Config\Database;

class RateLimiter {
    private PDO $pdo;

    public function __construct(?PDO $pdo = null) {
        $this->pdo = $pdo ?? Database::getConnection();
    }

    public function check(string $accion, int $maxIntentos = 5, int $ventanaMinutos = 15): array {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

        // 1. Limpiar registros antiguos expirados
        $stmt = $this->pdo->prepare("DELETE FROM rate_limits WHERE fecha_desbloqueo IS NOT NULL AND fecha_desbloqueo < NOW()");
        $stmt->execute();

        // 2. Verificar si está bloqueado actualmente
        $stmt = $this->pdo->prepare("
            SELECT fecha_desbloqueo 
            FROM rate_limits 
            WHERE ip_address = ? AND accion = ? AND fecha_bloqueo IS NOT NULL AND fecha_desbloqueo > NOW()
        ");
        $stmt->execute([$ip, $accion]);
        $bloqueado = $stmt->fetch();

        if ($bloqueado) {
            $minutosRestantes = ceil((strtotime($bloqueado['fecha_desbloqueo']) - time()) / 60);
            return [
                'permitido' => false,
                'mensaje'   => "Demasiados intentos. Intenta de nuevo en {$minutosRestantes} minutos."
            ];
        }

        // 3. Obtener o crear registro
        $stmt = $this->pdo->prepare("SELECT intentos, fecha_ultimo_intento FROM rate_limits WHERE ip_address = ? AND accion = ?");
        $stmt->execute([$ip, $accion]);
        $registro = $stmt->fetch();

        if (!$registro) {
            $stmt = $this->pdo->prepare("INSERT INTO rate_limits (ip_address, accion, intentos) VALUES (?, ?, 1)");
            $stmt->execute([$ip, $accion]);
            return ['permitido' => true];
        }

        // 4. Verificar si pasó la ventana de tiempo
        $tiempoUltimo = strtotime($registro['fecha_ultimo_intento']);
        $tiempoAhora = time();
        $minutosPasados = ($tiempoAhora - $tiempoUltimo) / 60;

        if ($minutosPasados >= $ventanaMinutos) {
            $stmt = $this->pdo->prepare("UPDATE rate_limits SET intentos = 1, fecha_ultimo_intento = NOW(), fecha_bloqueo = NULL, fecha_desbloqueo = NULL WHERE ip_address = ? AND accion = ?");
            $stmt->execute([$ip, $accion]);
            return ['permitido' => true];
        }

        // 5. Incrementar intentos
        $nuevosIntentos = $registro['intentos'] + 1;

        if ($nuevosIntentos >= $maxIntentos) {
            $fechaDesbloqueo = date('Y-m-d H:i:s', time() + ($ventanaMinutos * 60));
            $stmt = $this->pdo->prepare("
                UPDATE rate_limits 
                SET intentos = ?, fecha_bloqueo = NOW(), fecha_desbloqueo = ?, fecha_ultimo_intento = NOW() 
                WHERE ip_address = ? AND accion = ?
            ");
            $stmt->execute([$nuevosIntentos, $fechaDesbloqueo, $ip, $accion]);

            Logger::security('IP bloqueada por rate limiting', [
                'ip' => $ip,
                'accion' => $accion,
                'intentos' => $nuevosIntentos
            ]);

            return [
                'permitido' => false,
                'mensaje'   => "Has superado el límite de intentos. Bloqueado temporalmente por {$ventanaMinutos} minutos."
            ];
        }

        $stmt = $this->pdo->prepare("UPDATE rate_limits SET intentos = ?, fecha_ultimo_intento = NOW() WHERE ip_address = ? AND accion = ?");
        $stmt->execute([$nuevosIntentos, $ip, $accion]);

        return ['permitido' => true];
    }
}
