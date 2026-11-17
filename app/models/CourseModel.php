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

    public function getAllForAdmin(): array {
        $stmt = $this->db->prepare("
            SELECT c.*,
                   (SELECT COUNT(*) FROM lecciones WHERE curso_id = c.id AND activo = 1) as total_lecciones,
                   (SELECT COUNT(*) FROM ejercicios WHERE curso_id = c.id AND activo = 1) as total_ejercicios,
                   (SELECT COUNT(*) FROM audios WHERE curso_id = c.id AND activo = 1) as total_audios,
                   (SELECT COUNT(*) FROM libros WHERE curso_id = c.id AND activo = 1) as total_libros
            FROM cursos c
            ORDER BY c.semestre, c.orden, c.id
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function setActive(int $id, bool $activo): bool {
        $stmt = $this->db->prepare("UPDATE cursos SET activo = ? WHERE id = ?");
        return $stmt->execute([$activo ? 1 : 0, $id]);
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

    public function findByIdAdmin(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM cursos WHERE id = ?");
        $stmt->execute([$id]);
        $curso = $stmt->fetch();
        return $curso ?: null;
    }

    public function updateBasic(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE cursos
            SET codigo = ?, semestre = ?, titulo = ?, descripcion = ?, categoria = ?, nivel = ?, duracion_horas = ?, imagen_url = ?, orden = ?, activo = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['codigo'],
            $data['semestre'],
            $data['titulo'],
            $data['descripcion'],
            $data['categoria'],
            $data['nivel'],
            $data['duracion_horas'],
            $data['imagen_url'],
            $data['orden'],
            $data['activo'],
            $id,
        ]);
    }

    public function createCourse(array $data): int {
        $stmt = $this->db->prepare("
            INSERT INTO cursos (codigo, semestre, titulo, descripcion, categoria, nivel, duracion_horas, imagen_url, orden, activo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['codigo'],
            $data['semestre'],
            $data['titulo'],
            $data['descripcion'],
            $data['categoria'],
            $data['nivel'],
            $data['duracion_horas'],
            $data['imagen_url'],
            $data['orden'],
            $data['activo'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function deleteCourse(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM cursos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // ── LECCIONES (VIDEOS) ──────────────────────────────────────────

    public function getAllLessons(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM lecciones 
            WHERE curso_id = ? 
            ORDER BY orden ASC, id ASC
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function findLessonById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM lecciones WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function createLesson(int $cursoId, array $data): int {
        $stmt = $this->db->prepare("
            INSERT INTO lecciones (curso_id, titulo, contenido, video_url, duracion, orden, activo)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $cursoId,
            $data['titulo'],
            $data['contenido'],
            $data['video_url'],
            $data['duracion'],
            $data['orden'],
            $data['activo'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateLesson(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE lecciones
            SET titulo = ?, contenido = ?, video_url = ?, duracion = ?, orden = ?, activo = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['titulo'],
            $data['contenido'],
            $data['video_url'],
            $data['duracion'],
            $data['orden'],
            $data['activo'],
            $id,
        ]);
    }

    public function deleteLesson(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM lecciones WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // ── LIBROS (EBOOKS / LECTURAS) ──────────────────────────────────

    public function getAllBooks(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM libros 
            WHERE curso_id = ? 
            ORDER BY orden ASC, id ASC
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function findBookById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM libros WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function createBook(int $cursoId, array $data): int {
        $stmt = $this->db->prepare("
            INSERT INTO libros (curso_id, titulo, autor, descripcion, tipo, archivo_url, orden, activo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $cursoId,
            $data['titulo'],
            $data['autor'],
            $data['descripcion'],
            $data['tipo'],
            $data['archivo_url'],
            $data['orden'],
            $data['activo'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateBook(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE libros
            SET titulo = ?, autor = ?, descripcion = ?, tipo = ?, archivo_url = ?, orden = ?, activo = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['titulo'],
            $data['autor'],
            $data['descripcion'],
            $data['tipo'],
            $data['archivo_url'],
            $data['orden'],
            $data['activo'],
            $id,
        ]);
    }

    public function deleteBook(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM libros WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // ── AUDIOS (PODCASTS) ───────────────────────────────────────────

    public function getAllAudios(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM audios 
            WHERE curso_id = ? 
            ORDER BY orden ASC, id ASC
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function findAudioById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM audios WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function createAudio(int $cursoId, array $data): int {
        $stmt = $this->db->prepare("
            INSERT INTO audios (curso_id, titulo, descripcion, duracion, audio_url, orden, activo)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $cursoId,
            $data['titulo'],
            $data['descripcion'],
            $data['duracion'],
            $data['audio_url'],
            $data['orden'],
            $data['activo'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateAudio(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE audios
            SET titulo = ?, descripcion = ?, duracion = ?, audio_url = ?, orden = ?, activo = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['titulo'],
            $data['descripcion'],
            $data['duracion'],
            $data['audio_url'],
            $data['orden'],
            $data['activo'],
            $id,
        ]);
    }

    public function deleteAudio(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM audios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // ── EJERCICIOS (PRÁCTICAS / QUIZZES) ────────────────────────────

    public function getAllExercises(int $cursoId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM ejercicios 
            WHERE curso_id = ? 
            ORDER BY orden ASC, id ASC
        ");
        $stmt->execute([$cursoId]);
        return $stmt->fetchAll();
    }

    public function findExerciseById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM ejercicios WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function createExercise(int $cursoId, array $data): int {
        $stmt = $this->db->prepare("
            INSERT INTO ejercicios (curso_id, titulo, tipo, descripcion, orden, activo)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $cursoId,
            $data['titulo'],
            $data['tipo'],
            $data['descripcion'],
            $data['orden'],
            $data['activo'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function updateExercise(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE ejercicios
            SET titulo = ?, tipo = ?, descripcion = ?, orden = ?, activo = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['titulo'],
            $data['tipo'],
            $data['descripcion'],
            $data['orden'],
            $data['activo'],
            $id,
        ]);
    }

    public function deleteExercise(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM ejercicios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
