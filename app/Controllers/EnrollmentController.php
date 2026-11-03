<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\EnrollmentModel;

class EnrollmentController extends Controller {
    private EnrollmentModel $enrollmentModel;

    public function __construct() {
        parent::__construct();
        $this->enrollmentModel = new EnrollmentModel();
    }

    public function handle(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if ($method === 'GET') {
            $this->index();
        } elseif ($method === 'POST') {
            $this->store();
        } elseif ($method === 'DELETE') {
            $this->destroy();
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }
    }

    public function index(): void {
        $userId = $this->requireAuth();

        try {
            $materias = $this->enrollmentModel->getUserEnrollments($userId);
            $this->jsonResponse([
                'success'  => true,
                'inscritas'=> $materias
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al obtener inscripciones', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener inscripciones'], 500);
        }
    }

    public function store(): void {
        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $materiaId = trim($data['materia_id'] ?? '');
        $semestre  = (int)($data['semestre'] ?? 0);

        if ($semestre < 1 || $semestre > 4) {
            $this->jsonResponse(['success' => false, 'message' => 'El semestre debe estar entre 1 y 4'], 400);
        }

        if (empty($materiaId)) {
            $this->jsonResponse(['success' => false, 'message' => 'Materia no especificada'], 400);
        }

        try {
            $this->enrollmentModel->enroll($userId, $materiaId, $semestre);
            $this->jsonResponse([
                'success' => true,
                'message' => 'Inscripción exitosa'
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al inscribir materia', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al inscribir'], 500);
        }
    }

    public function destroy(): void {
        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $materiaId = trim($data['materia_id'] ?? '');
        if (empty($materiaId)) {
            $this->jsonResponse(['success' => false, 'message' => 'Materia no especificada'], 400);
        }

        try {
            $this->enrollmentModel->unenroll($userId, $materiaId);
            $this->jsonResponse(['success' => true, 'message' => 'Inscripción eliminada']);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar inscripción', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al eliminar inscripción'], 500);
        }
    }
}
