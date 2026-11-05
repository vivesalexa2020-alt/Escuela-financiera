<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\AchievementModel;

class AchievementController extends Controller {
    private AchievementModel $achievementModel;

    public function __construct() {
        parent::__construct();
        $this->achievementModel = new AchievementModel();
    }

    public function index(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();

        try {
            $puntos = $this->achievementModel->getUserPoints($userId);
            $desbloqueados = $this->achievementModel->getUnlockedAchievements($userId);
            $disponibles = $this->achievementModel->getAvailableAchievements($userId);

            $this->jsonResponse([
                'success'               => true,
                'puntos'                => $puntos,
                'logros_desbloqueados'  => $desbloqueados,
                'logros_disponibles'    => $disponibles
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al obtener logros y puntos', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener logros'], 500);
        }
    }
}
