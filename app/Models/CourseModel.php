<?php
namespace App\Models;

use App\Core\Model;

class CourseModel extends Model {
    public function getAllWithCounts(): array {
        $stmt = $this->db->prepare("
            SELECT c.*, 
                   (SELECT COUNT(*) FROM lecciones WHERE curso_id = c.id AND activo = 1) as total_lecciones,
                   (SELECT COUNT(*) FROM ejercicios WHERE curso_id = c.id AND activo = 1) as total_ejercicios,
                   (SELECT COUNT(*) FROM audios WHERE curso_id = c.id AND activo = 1) as total_audios,
                   (SELECT COUNT(*) FROM libros WHERE curso_id = c.id AND activo = 1) as total_libros
            FROM cursos c 
            WHERE c.activo = 1 
            ORDER BY c.orden, c.id
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT c.*, 
                   (SELECT COUNT(*) FROM lecciones WHERE curso_id = c.id AND activo = 1) as total_lecciones,
                   (SELECT COUNT(*) FROM ejercicios WHERE curso_id = c.id AND activo = 1) as total_ejercicios,
                   (SELECT COUNT(*) FROM audios WHERE curso_id = c.id AND activo = 1) as total_audios,
                   (SELECT COUNT(*) FROM libros WHERE curso_id = c.id AND activo = 1) as total_libros
            FROM cursos c 
            WHERE c.id = ? AND c.activo = 1
        ");
        $stmt->execute([$id]);
        $curso = $stmt->fetch();
        return $curso ?: null;
    }

    public function getLessons(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM lecciones 
            WHERE curso_id = ? AND activo = 1 
            ORDER BY orden
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function getExercises(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM ejercicios 
            WHERE curso_id = ? AND activo = 1 
            ORDER BY orden
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function getAudios(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM audios 
            WHERE curso_id = ? AND activo = 1 
            ORDER BY orden
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function getBooks(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM libros 
            WHERE curso_id = ? AND activo = 1 
            ORDER BY orden
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function getFullCourse(int $id): ?array {
        $curso = $this->getById($id);
        if (!$curso) {
            return null;
        }

        $curso['lecciones'] = $this->getLessons($id);
        $curso['ejercicios'] = $this->getExercises($id);
        $curso['audios']    = $this->getAudios($id);
        $curso['libros']    = $this->getBooks($id);

        return $curso;
    }
}
