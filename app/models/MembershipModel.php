<?php
namespace App\Models;

use App\Core\Model;

class MembershipModel extends Model {
    public function getByUser(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT activa, tipo_membresia, fecha_inicio, fecha_vencimiento 
            FROM membresias 
            WHERE usuario_id = ?
        ");
        $stmt->execute([$userId]);
        $membresia = $stmt->fetch();

        if (!$membresia) {
            $stmt = $this->db->prepare("
                INSERT INTO membresias (usuario_id, activa, tipo_membresia, fecha_inicio, fecha_vencimiento) 
                VALUES (?, 1, 'gratis', NOW(), DATE_ADD(NOW(), INTERVAL 1 MONTH))
                ON DUPLICATE KEY UPDATE activa = 1
            ");
            $stmt->execute([$userId]);
            $membresia = [
                'activa'            => 1,
                'tipo_membresia'    => 'gratis',
                'fecha_inicio'      => date('Y-m-d H:i:s'),
                'fecha_vencimiento' => date('Y-m-d H:i:s', strtotime('+1 month'))
            ];
        }

        return $membresia;
    }

    public function getAllWithUsers(): array {
        $stmt = $this->db->query("
            SELECT m.id, m.usuario_id, m.activa, m.tipo_membresia, m.fecha_inicio, m.fecha_vencimiento,
                   u.nombre AS usuario_nombre, u.email AS usuario_email
            FROM membresias m
            INNER JOIN usuarios u ON u.id = m.usuario_id
            WHERE u.eliminado_en IS NULL
            ORDER BY m.fecha_inicio DESC, m.id DESC
        ");
        return $stmt->fetchAll() ?: [];
    }

    public function countActive(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM membresias WHERE activa = 1");
        return (int)$stmt->fetchColumn();
    }

    public function updateById(int $id, string $tipo, bool $activa, ?string $fechaVencimiento): bool {
        $stmt = $this->db->prepare("
            UPDATE membresias
            SET tipo_membresia = ?, activa = ?, fecha_vencimiento = ?
            WHERE id = ?
        ");
        return $stmt->execute([$tipo, $activa ? 1 : 0, $fechaVencimiento, $id]);
    }

    public function updateMembership(int $userId, string $tipo, ?string $fechaVencimiento = null): bool {
        $fechaVencimiento = $fechaVencimiento
            ?? date('Y-m-d H:i:s', strtotime($tipo === 'gratis' ? '+1 month' : '+1 year'));

        $existe = $this->db->prepare("SELECT COUNT(*) FROM membresias WHERE usuario_id = ?");
        $existe->execute([$userId]);
        if ((int)$existe->fetchColumn() > 0) {
            $stmt = $this->db->prepare("
                UPDATE membresias
                SET tipo_membresia = ?, activa = 1, fecha_vencimiento = ?
                WHERE usuario_id = ?
            ");
            return $stmt->execute([$tipo, $fechaVencimiento, $userId]);
        }

        $stmt = $this->db->prepare("
            INSERT INTO membresias (usuario_id, activa, tipo_membresia, fecha_inicio, fecha_vencimiento)
            VALUES (?, 1, ?, NOW(), ?)
        ");
        return $stmt->execute([$userId, $tipo, $fechaVencimiento]);
    }
}
