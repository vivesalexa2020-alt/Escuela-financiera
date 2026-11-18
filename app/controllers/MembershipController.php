<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Models\MembershipModel;

class MembershipController extends Controller {
    private MembershipModel $membershipModel;

    public function __construct() {
        parent::__construct();
        $this->membershipModel = new MembershipModel();
    }

    public function index(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->activate();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();

        try {
            $membresia = $this->membershipModel->getByUser($userId);
            $this->jsonResponse([
                'success'   => true,
                'membresia' => $membresia
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al obtener membresía', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener membresía'], 500);
        }
    }

    public function activate(): void {
        $userId = $this->requireAuth();
        try {
            $this->membershipModel->updateMembership($userId, 'pro');
            \App\Core\Session::set('membresia', 'pro');
            $this->jsonResponse([
                'success' => true,
                'message' => 'Membresía Pro activada con éxito'
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al activar membresía', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al activar membresía'], 500);
        }
    }
}
