<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\ProgressModel;
use App\Models\AchievementModel;

class ProgressController extends Controller {
    private ProgressModel $progressModel;

    public function __construct() {
        parent::__construct();
        $this->progressModel = new ProgressModel();
    }

    public function index(): void {
        $userId = $this->requireAuth();
        $cursoId = isset($_GET['curso_id']) ? (int)$_GET['curso_id'] : null;

        try {
            if ($cursoId) {
                $progreso = $this->progressModel->getByCourse($userId, $cursoId);
                $leccionesCompletadas = $this->progressModel->getCompletedLessonIds($userId, $cursoId);
                $this->jsonResponse([
                    'success'               => true,
                    'progreso'              => $progreso,
                    'completado'            => $progreso ? (bool)$progreso['completado'] : false,
                    'lecciones_completadas' => $leccionesCompletadas
                ]);
            } else {
                $progresos = $this->progressModel->getAllByUser($userId);
                $this->jsonResponse([
                    'success'   => true,
                    'progresos' => $progresos
                ]);
            }
        } catch (\Throwable $e) {
            Logger::error('Error al consultar progreso', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener progreso'], 500);
        }
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $cursoId   = isset($data['curso_id']) ? (int)$data['curso_id'] : null;
        $leccionId = isset($data['leccion_id']) && (int)$data['leccion_id'] > 0 ? (int)$data['leccion_id'] : null;
        $completado= !empty($data['completado']) ? 1 : 0;

        if (!$cursoId || $cursoId <= 0) {
            $this->jsonResponse(['success' => false, 'message' => 'ID de curso válido es obligatorio'], 400);
        }

        try {
            $result = $this->progressModel->saveProgress($userId, $cursoId, $leccionId, $completado);

            // Verificar y desbloquear logros automáticamente
            $achievementModel = new AchievementModel();
            $logrosDesbloqueados = $achievementModel->checkAndUnlock($userId);

            $this->jsonResponse([
                'success'               => true,
                'message'               => 'Progreso actualizado exitosamente',
                'porcentaje'            => $result['porcentaje'],
                'completado'            => $result['completado'],
                'total_lecciones'       => $result['total_lecciones'] ?? null,
                'lecciones_completadas' => $result['lecciones_completadas'] ?? null,
                'nuevos_logros'         => $logrosDesbloqueados
            ]);
        } catch (\Throwable $e) {
            Logger::error('Error al guardar progreso', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al actualizar progreso'], 500);
        }
    }
}
