<?php
namespace App\Models;

use App\Core\Model;

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
        return $stmt->fetchAll();
    }

    public function getAvailableAchievements(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT l.* FROM logros l 
            WHERE l.activo = 1 
            AND l.id NOT IN (SELECT logro_id FROM logros_usuario WHERE usuario_id = ?)
            ORDER BY l.puntos_requeridos ASC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function addPoints(int $userId, int $points): array {
        $stmt = $this->db->prepare("
            INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) 
            VALUES (?, ?, 1) 
            ON DUPLICATE KEY UPDATE 
            puntos_totales = puntos_totales + VALUES(puntos_totales),
            nivel = FLOOR(puntos_totales / 500) + 1
        ");
        $stmt->execute([$userId, $points]);

        return $this->getUserPoints($userId);
    }
}
