<?php
namespace App\Models;

use App\Core\Model;

class EnrollmentModel extends Model {
    public function getUserEnrollments(int $userId): array {
        $stmt = $this->db->prepare("SELECT materia_id FROM inscripciones WHERE usuario_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN) ?: [];
    }

    public function getUserEnrollmentDetails(int $userId): array {
        $stmt = $this->db->prepare("SELECT materia_id, semestre, fecha_inscripcion FROM inscripciones WHERE usuario_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function enroll(int $userId, string $materiaId, int $semestre): bool {
        $stmt = $this->db->prepare("
            INSERT IGNORE INTO inscripciones (usuario_id, materia_id, semestre) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$userId, $materiaId, $semestre]);
    }

    public function unenroll(int $userId, string $materiaId): bool {
        $stmt = $this->db->prepare("DELETE FROM inscripciones WHERE usuario_id = ? AND materia_id = ?");
        return $stmt->execute([$userId, $materiaId]);
    }

    public function isEnrolled(int $userId, string $materiaId): bool {
        $stmt = $this->db->prepare("SELECT id FROM inscripciones WHERE usuario_id = ? AND materia_id = ?");
        $stmt->execute([$userId, $materiaId]);
        return (bool)$stmt->fetch();
    }

    public function countAll(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM inscripciones");
        return (int)$stmt->fetchColumn();
    }

    public function getAllForAdmin(): array {
        $stmt = $this->db->query("
            SELECT i.*, u.nombre AS usuario_nombre, u.email AS usuario_email
            FROM inscripciones i
            INNER JOIN usuarios u ON u.id = i.usuario_id
            WHERE u.eliminado_en IS NULL
            ORDER BY i.fecha_inscripcion DESC, i.id DESC
        ");
        return $stmt->fetchAll();
    }
}
