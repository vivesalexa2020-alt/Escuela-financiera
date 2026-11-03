<?php
/**
 * Rate Limiter Middleware
 * Protege contra ataques de fuerza bruta limitando intentos por IP
 */

function checkRateLimit($pdo, $accion, $maxIntentos = 5, $ventanaMinutos = 15) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    
    // Limpiar registros antiguos
    $stmt = $pdo->prepare("DELETE FROM rate_limits WHERE fecha_desbloqueo < NOW()");
    $stmt->execute();
    
    // Verificar si está bloqueado
    $stmt = $pdo->prepare("SELECT fecha_desbloqueo FROM rate_limits WHERE ip_address = ? AND accion = ? AND fecha_bloqueo IS NOT NULL AND fecha_desbloqueo > NOW()");
    $stmt->execute([$ip, $accion]);
    $bloqueado = $stmt->fetch();
    
    if ($bloqueado) {
        $minutosRestantes = ceil((strtotime($bloqueado['fecha_desbloqueo']) - time()) / 60);
        return [
            'permitido' => false,
            'mensaje' => "Demasiados intentos. Intenta de nuevo en {$minutosRestantes} minutos."
        ];
    }
    
    // Obtener o crear registro
    $stmt = $pdo->prepare("SELECT intentos, fecha_ultimo_intento FROM rate_limits WHERE ip_address = ? AND accion = ?");
    $stmt->execute([$ip, $accion]);
    $registro = $stmt->fetch();
    
    if (!$registro) {
        // Primer intento
        $stmt = $pdo->prepare("INSERT INTO rate_limits (ip_address, accion, intentos) VALUES (?, ?, 1)");
        $stmt->execute([$ip, $accion]);
        return ['permitido' => true];
    }
    
    // Verificar si pasó la ventana de tiempo
    $tiempoUltimo = strtotime($registro['fecha_ultimo_intento']);
    $tiempoAhora = time();
    $minutosPasados = ($tiempoAhora - $tiempoUltimo) / 60;
    
    if ($minutosPasados >= $ventanaMinutos) {
        // Reiniciar contador
        $stmt = $pdo->prepare("UPDATE rate_limits SET intentos = 1, fecha_ultimo_intento = NOW() WHERE ip_address = ? AND accion = ?");
        $stmt->execute([$ip, $accion]);
        return ['permitido' => true];
    }
    
    // Incrementar intentos
    $nuevosIntentos = $registro['intentos'] + 1;
    
    if ($nuevosIntentos >= $maxIntentos) {
        // Bloquear
        $fechaDesbloqueo = date('Y-m-d H:i:s', time() + ($ventanaMinutos * 60));
        $stmt = $pdo->prepare("UPDATE rate_limits SET intentos = ?, fecha_bloqueo = NOW(), fecha_desbloqueo = ? WHERE ip_address = ? AND accion = ?");
        $stmt->execute([$nuevosIntentos, $fechaDesbloqueo, $ip, $accion]);
        return [
            'permitido' => false,
            'mensaje' => "Demasiados intentos. Intenta de nuevo en {$ventanaMinutos} minutos."
        ];
    }
    
    // Actualizar contador
    $stmt = $pdo->prepare("UPDATE rate_limits SET intentos = ?, fecha_ultimo_intento = NOW() WHERE ip_address = ? AND accion = ?");
    $stmt->execute([$nuevosIntentos, $ip, $accion]);
    
    $intentosRestantes = $maxIntentos - $nuevosIntentos;
    return [
        'permitido' => true,
        'intentos_restantes' => $intentosRestantes
    ];
}

function logLoginAttempt($pdo, $usuarioId, $email, $exitoso) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    $stmt = $pdo->prepare("INSERT INTO login_logs (usuario_id, email, ip_address, user_agent, exitoso) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$usuarioId, $email, $ip, $userAgent, $exitoso ? 1 : 0]);
}
