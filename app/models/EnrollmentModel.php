<?php
namespace App\Models;

use App\Core\Model;

class EnrollmentModel extends Model {
    public function getUserEnrollments(int $userId): array {
        $stmt = $this->db->prepare("SELECT materia_id, semestre, fecha_inscripcion FROM inscripciones WHERE usuario_id = ?");
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll();

        return array_map(fn($row) => $row['materia_id'], $rows);
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
}
