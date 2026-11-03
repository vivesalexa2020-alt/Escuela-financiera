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
            $stmt = $this->db->prepare("INSERT INTO membresias (usuario_id, activa, tipo_membresia) VALUES (?, 1, 'gratis')");
            $stmt->execute([$userId]);
            $membresia = [
                'activa'            => 1,
                'tipo_membresia'    => 'gratis',
                'fecha_inicio'      => date('Y-m-d H:i:s'),
                'fecha_vencimiento' => null
            ];
        }

        return $membresia;
    }

    public function updateMembership(int $userId, string $tipo, ?string $fechaVencimiento = null): bool {
        $stmt = $this->db->prepare("
            UPDATE membresias 
            SET tipo_membresia = ?, activa = 1, fecha_vencimiento = ? 
            WHERE usuario_id = ?
        ");
        return $stmt->execute([$tipo, $fechaVencimiento, $userId]);
    }
}
