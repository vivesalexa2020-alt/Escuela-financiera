<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Logger;

class ProgressModel extends Model {
    public function getByCourse(int $userId, int $cursoId): ?array {
        $stmt = $this->db->prepare("
            SELECT p.*, 
                   (SELECT COUNT(*) FROM lecciones WHERE curso_id = ? AND activo = 1) as total_lecciones
            FROM progreso_usuario p 
            WHERE p.usuario_id = ? AND p.curso_id = ?
        ");
        $stmt->execute([$cursoId, $userId, $cursoId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function getAllByUser(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT p.*, c.titulo as curso_titulo 
            FROM progreso_usuario p 
            JOIN cursos c ON p.curso_id = c.id 
            WHERE p.usuario_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function saveProgress(int $userId, int $cursoId, ?int $leccionId, int $completado): array {
        // Verificar existencia previa
        $stmt = $this->db->prepare("SELECT id FROM progreso_usuario WHERE usuario_id = ? AND curso_id = ?");
        $stmt->execute([$userId, $cursoId]);
        $existente = $stmt->fetch();

        if ($existente) {
            if ($leccionId) {
                $stmt = $this->db->prepare("
                    UPDATE progreso_usuario 
                    SET leccion_id = ?, completado = ?, fecha_actualizacion = NOW() 
                    WHERE usuario_id = ? AND curso_id = ?
                ");
                $stmt->execute([$leccionId, $completado, $userId, $cursoId]);
            }
        } else {
            $stmt = $this->db->prepare("
                INSERT INTO progreso_usuario (usuario_id, curso_id, leccion_id, completado, fecha_inicio) 
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->execute([$userId, $cursoId, $leccionId, $completado]);
        }

        // Calcular porcentaje
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM lecciones WHERE curso_id = ? AND activo = 1");
        $stmt->execute([$cursoId]);
        $totalLecciones = (int)$stmt->fetchColumn();

        $porcentaje = 0;
        if ($totalLecciones > 0) {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) FROM progreso_usuario 
                WHERE usuario_id = ? AND curso_id = ? AND completado = 1
            ");
            $stmt->execute([$userId, $cursoId]);
            $leccionesCompletadas = (int)$stmt->fetchColumn();

            $porcentaje = round(($leccionesCompletadas / $totalLecciones) * 100, 2);

            $stmt = $this->db->prepare("
                UPDATE progreso_usuario 
                SET porcentaje = ? 
                WHERE usuario_id = ? AND curso_id = ?
            ");
            $stmt->execute([$porcentaje, $userId, $cursoId]);

            // Si completó 100%, registrar fecha y otorgar XP
            if ($porcentaje >= 100) {
                $stmt = $this->db->prepare("
                    UPDATE progreso_usuario 
                    SET fecha_completado = NOW() 
                    WHERE usuario_id = ? AND curso_id = ?
                ");
                $stmt->execute([$userId, $cursoId]);

                $stmt = $this->db->prepare("
                    INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) 
                    VALUES (?, 100, 1) 
                    ON DUPLICATE KEY UPDATE 
                    puntos_totales = puntos_totales + 100,
                    nivel = FLOOR(puntos_totales / 500) + 1
                ");
                $stmt->execute([$userId]);

                Logger::info('Curso completado con éxito', ['usuario_id' => $userId, 'curso_id' => $cursoId]);
            }
        }

        return [
            'porcentaje' => $porcentaje,
            'completado' => $porcentaje >= 100,
        ];
    }
}
