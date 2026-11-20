<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Logger;

class AchievementModel extends Model {
    public function getUserPoints(int $userId): array {
        $stmt = $this->db->prepare("SELECT puntos_totales, nivel FROM puntos_usuario WHERE usuario_id = ?");
        $stmt->execute([$userId]);
        $puntos = $stmt->fetch();

        if (!$puntos) {
            $stmt = $this->db->prepare("INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) VALUES (?, 0, 1)");
            $stmt->execute([$userId]);
            return ['puntos_totales' => 0, 'nivel' => 1];
        }

        return $puntos;
    }

    public function getUnlockedAchievements(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT l.*, lu.fecha_desbloqueo 
            FROM logros_usuario lu 
            JOIN logros l ON lu.logro_id = l.id 
            WHERE lu.usuario_id = ?
            ORDER BY lu.fecha_desbloqueo DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll() ?: [];
    }

    public function getAvailableAchievements(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT l.* FROM logros l 
            WHERE l.activo = 1 
            AND l.id NOT IN (SELECT logro_id FROM logros_usuario WHERE usuario_id = ?)
            ORDER BY l.puntos_requeridos ASC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll() ?: [];
    }

    public function checkAndUnlock(int $userId): array {
        $puntosData = $this->getUserPoints($userId);
        $puntos = (int)($puntosData['puntos_totales'] ?? 0);

        // Contar cursos completados por el usuario
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM progreso_usuario WHERE usuario_id = ? AND completado = 1");
        $stmt->execute([$userId]);
        $cursosCompletados = (int)$stmt->fetchColumn();

        // Buscar logros activos aún no desbloqueados que el usuario ya cumple
        $stmt = $this->db->prepare("
            SELECT l.id, l.nombre, l.descripcion, l.icono
            FROM logros l
            WHERE l.activo = 1
              AND l.id NOT IN (SELECT logro_id FROM logros_usuario WHERE usuario_id = ?)
              AND l.puntos_requeridos <= ?
              AND (l.cursos_requeridos IS NULL OR l.cursos_requeridos <= ?)
        ");
        $stmt->execute([$userId, $puntos, $cursosCompletados]);
        $candidatos = $stmt->fetchAll();

        $desbloqueados = [];
        if (!empty($candidatos)) {
            $insertStmt = $this->db->prepare("
                INSERT IGNORE INTO logros_usuario (usuario_id, logro_id, fecha_desbloqueo)
                VALUES (?, ?, NOW())
            ");
            foreach ($candidatos as $logro) {
                $insertStmt->execute([$userId, $logro['id']]);
                $desbloqueados[] = $logro;
                Logger::info('Logro desbloqueado automáticamente', [
                    'usuario_id' => $userId,
                    'logro_id' => $logro['id'],
                    'logro_nombre' => $logro['nombre']
                ]);
            }
        }

        return $desbloqueados;
    }

    public function getAllForAdmin(): array {
        $stmt = $this->db->query("
            SELECT l.*,
                   (SELECT COUNT(*) FROM logros_usuario lu WHERE lu.logro_id = l.id) AS total_desbloqueos
            FROM logros l
            ORDER BY l.puntos_requeridos ASC, l.id ASC
        ");
        return $stmt->fetchAll() ?: [];
    }

    public function setActive(int $id, bool $activo): bool {
        $stmt = $this->db->prepare("UPDATE logros SET activo = ? WHERE id = ?");
        return $stmt->execute([$activo ? 1 : 0, $id]);
    }

    public function createLogro(array $data): int {
        $stmt = $this->db->prepare("
            INSERT INTO logros (nombre, descripcion, icono, puntos_requeridos, cursos_requeridos, activo)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['icono'] ?: '🏅',
            $data['puntos_requeridos'],
            $data['cursos_requeridos'] ?: null,
            $data['activo'] ?? 1,
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function deleteLogro(int $id): bool {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("DELETE FROM logros_usuario WHERE logro_id = ?");
            $stmt->execute([$id]);

            $stmt = $this->db->prepare("DELETE FROM logros WHERE id = ?");
            $res = $stmt->execute([$id]);
            $this->db->commit();
            return $res;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            Logger::error('Error al eliminar logro', ['logro_id' => $id, 'error' => $e->getMessage()]);
            return false;
        }
    }

    public function addPoints(int $userId, int $points): array {
        $stmt = $this->db->prepare("
            INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) 
            VALUES (?, ?, 1) 
            ON DUPLICATE KEY UPDATE 
            puntos_totales = puntos_totales + VALUES(puntos_totales),
            nivel = FLOOR((puntos_totales + VALUES(puntos_totales)) / 500) + 1
        ");
        $stmt->execute([$userId, $points]);

        // Verificar si los nuevos puntos desbloquearon logros
        $this->checkAndUnlock($userId);

        return $this->getUserPoints($userId);
    }
}
