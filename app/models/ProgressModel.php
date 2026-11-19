<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Logger;

class ProgressModel extends Model {
    public function getByCourse(int $userId, int $cursoId): ?array {
        $stmt = $this->db->prepare("
            SELECT p.*, 
                   (SELECT COUNT(*) FROM lecciones WHERE curso_id = :cid1 AND activo = 1) as total_lecciones,
                   (SELECT COUNT(DISTINCT pl.leccion_id) 
                    FROM progreso_lecciones pl
                    INNER JOIN lecciones l ON l.id = pl.leccion_id
                    WHERE pl.usuario_id = :uid1 AND pl.curso_id = :cid2 AND pl.completado = 1 AND l.activo = 1
                   ) as lecciones_completadas
            FROM progreso_usuario p 
            WHERE p.usuario_id = :uid2 AND p.curso_id = :cid3
        ");
        $stmt->execute([
            ':cid1' => $cursoId,
            ':uid1' => $userId,
            ':cid2' => $cursoId,
            ':uid2' => $userId,
            ':cid3' => $cursoId
        ]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function getCompletedLessonIds(int $userId, int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT leccion_id 
            FROM progreso_lecciones 
            WHERE usuario_id = ? AND curso_id = ? AND completado = 1
        ");
        $stmt->execute([$userId, $cursoId]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN) ?: [];
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

    public function getAllForAdmin(): array {
        $stmt = $this->db->query("
            SELECT p.*, u.nombre AS usuario_nombre, u.email AS usuario_email,
                   c.titulo AS curso_titulo, c.codigo AS curso_codigo, c.semestre
            FROM progreso_usuario p
            INNER JOIN usuarios u ON u.id = p.usuario_id
            INNER JOIN cursos c ON c.id = p.curso_id
            WHERE u.eliminado_en IS NULL
            ORDER BY p.fecha_actualizacion DESC, p.id DESC
        ");
        return $stmt->fetchAll();
    }

    public function saveProgress(int $userId, int $cursoId, ?int $leccionId, int $completado): array {
        $this->db->beginTransaction();
        try {
            // 1. Guardar progreso de lección individual
            if ($leccionId !== null && $leccionId > 0) {
                if ($completado === 1) {
                    $stmt = $this->db->prepare("
                        INSERT INTO progreso_lecciones (usuario_id, curso_id, leccion_id, completado, fecha_completado) 
                        VALUES (?, ?, ?, 1, NOW())
                        ON DUPLICATE KEY UPDATE completado = 1, fecha_completado = NOW()
                    ");
                    $stmt->execute([$userId, $cursoId, $leccionId]);
                } else {
                    $stmt = $this->db->prepare("
                        UPDATE progreso_lecciones 
                        SET completado = 0 
                        WHERE usuario_id = ? AND leccion_id = ?
                    ");
                    $stmt->execute([$userId, $leccionId]);
                }
            }

            // 2. Conteo de lecciones del curso
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM lecciones WHERE curso_id = ? AND activo = 1");
            $stmt->execute([$cursoId]);
            $totalLecciones = (int)$stmt->fetchColumn();

            // 3. Conteo de lecciones completadas del curso
            $stmt = $this->db->prepare("
                SELECT COUNT(DISTINCT pl.leccion_id) 
                FROM progreso_lecciones pl
                INNER JOIN lecciones l ON l.id = pl.leccion_id
                WHERE pl.usuario_id = ? AND pl.curso_id = ? AND pl.completado = 1 AND l.activo = 1
            ");
            $stmt->execute([$userId, $cursoId]);
            $leccionesCompletadas = (int)$stmt->fetchColumn();

            $porcentaje = $totalLecciones > 0 ? round(($leccionesCompletadas / $totalLecciones) * 100, 2) : 0.00;
            $isCompletado = ($porcentaje >= 100.0) ? 1 : 0;

            // 4. Verificar si el curso ya existía y si ya estaba completado
            $stmt = $this->db->prepare("SELECT id, fecha_completado FROM progreso_usuario WHERE usuario_id = ? AND curso_id = ?");
            $stmt->execute([$userId, $cursoId]);
            $existente = $stmt->fetch();

            $yaEstabaCompletado = ($existente && !empty($existente['fecha_completado']));

            if ($existente) {
                $stmt = $this->db->prepare("
                    UPDATE progreso_usuario 
                    SET leccion_id = COALESCE(?, leccion_id),
                        completado = ?,
                        porcentaje = ?,
                        fecha_completado = CASE 
                            WHEN ? = 1 AND fecha_completado IS NULL THEN NOW() 
                            ELSE fecha_completado 
                        END,
                        fecha_actualizacion = NOW()
                    WHERE usuario_id = ? AND curso_id = ?
                ");
                $stmt->execute([$leccionId, $isCompletado, $porcentaje, $isCompletado, $userId, $cursoId]);
            } else {
                $stmt = $this->db->prepare("
                    INSERT INTO progreso_usuario (usuario_id, curso_id, leccion_id, completado, porcentaje, fecha_inicio, fecha_completado) 
                    VALUES (?, ?, ?, ?, ?, NOW(), CASE WHEN ? = 1 THEN NOW() ELSE NULL END)
                ");
                $stmt->execute([$userId, $cursoId, $leccionId, $isCompletado, $porcentaje, $isCompletado]);
            }

            // 5. Otorgar XP sólo UNA VEZ cuando alcanza 100% por primera vez
            if ($isCompletado === 1 && !$yaEstabaCompletado) {
                $stmt = $this->db->prepare("
                    INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) 
                    VALUES (?, 100, 1) 
                    ON DUPLICATE KEY UPDATE 
                    puntos_totales = puntos_totales + 100,
                    nivel = FLOOR((puntos_totales + 100) / 500) + 1
                ");
                $stmt->execute([$userId]);

                Logger::info('Curso completado con éxito por primera vez', ['usuario_id' => $userId, 'curso_id' => $cursoId]);
            }

            $this->db->commit();

            return [
                'porcentaje' => $porcentaje,
                'completado' => (bool)$isCompletado,
                'total_lecciones' => $totalLecciones,
                'lecciones_completadas' => $leccionesCompletadas
            ];
        } catch (\Throwable $e) {
            $this->db->rollBack();
            Logger::error('Error al guardar progreso', [
                'error' => $e->getMessage(),
                'usuario_id' => $userId,
                'curso_id' => $cursoId
            ]);
            throw $e;
        }
    }
}
