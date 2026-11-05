<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\CourseModel;

class CourseController extends Controller {
    private CourseModel $courseModel;

    public function __construct() {
        parent::__construct();
        $this->courseModel = new CourseModel();
    }

    public function index(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        try {
            $cursos = $this->courseModel->getAllWithCounts();
            $this->jsonResponse([
                'success' => true,
                'cursos'  => $cursos
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al listar cursos', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener cursos'], 500);
        }
    }

    public function show(string $id = ''): void {
        $courseId = (int)($id ?: ($_GET['id'] ?? 0));
        if ($courseId <= 0) {
            $this->jsonResponse(['success' => false, 'message' => 'ID de curso no válido'], 400);
        }

        try {
            $curso = $this->courseModel->getFullCourse($courseId);
            if (!$curso) {
                $this->jsonResponse(['success' => false, 'message' => 'Curso no encontrado'], 404);
            }

            $this->jsonResponse([
                'success' => true,
                'curso'   => $curso
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al obtener curso', ['id' => $courseId, 'error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener la información del curso'], 500);
        }
    }
}
