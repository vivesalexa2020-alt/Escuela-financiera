<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Core\Session;
use App\Models\MembershipModel;

class MembershipController extends Controller {
    private MembershipModel $membershipModel;

    public function __construct() {
        parent::__construct();
        $this->membershipModel = new MembershipModel();
    }

    public function index(): void {
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
        } catch (\Throwable $e) {
            Logger::error('Error al obtener membresía', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al obtener membresía'], 500);
        }
    }

    public function activate(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $this->validateCsrf($data['csrf_token'] ?? null);

        $tipo = strtolower(trim($data['tipo'] ?? 'pro'));
        $permitidos = ['pro', 'premium'];
        if (!in_array($tipo, $permitidos, true)) {
            $this->jsonResponse(['success' => false, 'message' => 'Tipo de membresía no válido. Opciones: pro, premium'], 400);
        }

        // Validación de pago / método
        $metodoPago = trim($data['metodo_pago'] ?? ($data['metodo'] ?? ''));
        $referencia = trim($data['referencia_pago'] ?? ($data['referencia'] ?? ''));

        if (empty($metodoPago) && empty($referencia)) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Se requiere confirmación o comprobante de método de pago para activar la suscripción'
            ], 400);
        }

        try {
            $this->membershipModel->updateMembership($userId, $tipo);
            Session::set('membresia', $tipo);

            Logger::info('Membresía activada', [
                'usuario_id' => $userId,
                'tipo' => $tipo,
                'metodo' => $metodoPago
            ]);

            $this->jsonResponse([
                'success' => true,
                'message' => "Membresía {$tipo} activada con éxito",
                'tipo'    => $tipo
            ]);
        } catch (\Throwable $e) {
            Logger::error('Error al activar membresía', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al procesar la activación de membresía'], 500);
        }
    }
}
