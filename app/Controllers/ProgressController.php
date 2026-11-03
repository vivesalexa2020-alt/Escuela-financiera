<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\ProgressModel;

class ProgressController extends Controller {
    private ProgressModel $progressModel;

    public function __construct() {
        parent::__construct();
        $this->progressModel = new ProgressModel();
    }

    public function handle(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if ($method === 'GET') {
            $this->index();
        } elseif ($method === 'POST') {
            $this->store();
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }
    }

    public function index(): void {
        $userId = $this->requireAuth();
        $cursoId = isset($_GET['curso_id']) ? (int)$_GET['curso_id'] : null;

        try {
            if ($cursoId) {
                $progreso = $this->progressModel->getByCourse($userId, $cursoId);
                $this->jsonResponse([
                    'success'    => true,
                    'progreso'   => $progreso,
                    'completado' => $progreso ? (bool)$progreso['completado'] : false
                ]);
            } else {
                $progresos = $this->progressModel->getAllByUser($userId);
                $this->jsonResponse([
                    'success'   => true,
                    'progresos' => $progresos
                ]);
            }
        } catch (\Exception $e) {
            Logger::error('Error al consultar progreso', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener progreso'], 500);
        }
    }

    public function store(): void {
        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $cursoId   = isset($data['curso_id']) ? (int)$data['curso_id'] : null;
        $leccionId = isset($data['leccion_id']) ? (int)$data['leccion_id'] : null;
        $completado= (int)($data['completado'] ?? 0);

        if (!$cursoId) {
            $this->jsonResponse(['success' => false, 'message' => 'ID de curso es obligatorio'], 400);
        }

        try {
            $result = $this->progressModel->saveProgress($userId, $cursoId, $leccionId, $completado);
            $this->jsonResponse([
                'success'    => true,
                'message'    => 'Progreso actualizado',
                'porcentaje' => $result['porcentaje'],
                'completado' => $result['completado']
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al guardar progreso', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al actualizar progreso'], 500);
        }
    }
}
