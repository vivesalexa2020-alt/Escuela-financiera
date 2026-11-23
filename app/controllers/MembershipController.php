<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Logger;
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

    public function registrarPago(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $this->validateCsrf($data['csrf_token'] ?? null);

        $tipo = strtolower(trim($data['tipo'] ?? 'pro'));
        if ($tipo !== 'pro') {
            $this->jsonResponse(['success' => false, 'message' => 'Plan no válido para este pago'], 400);
        }

        $metodoPago = strtolower(trim($data['metodo_pago'] ?? ($data['metodo'] ?? '')));
        if (!in_array($metodoPago, ['spei', 'tarjeta'], true)) {
            $this->jsonResponse(['success' => false, 'message' => 'Selecciona un método de pago válido'], 400);
        }

        $referencia = trim((string)($data['referencia_pago'] ?? ($data['referencia'] ?? '')));
        if (!preg_match('/^[A-Za-z0-9\-_. ]{6,100}$/', $referencia)) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Ingresa la referencia o folio de tu pago (entre 6 y 100 caracteres)'
            ], 400);
        }

        $monto = (float)($data['monto'] ?? 1500);
        if (abs($monto - 1500.0) > 0.01) {
            $this->jsonResponse(['success' => false, 'message' => 'El monto de la membresía debe ser $1,500 MXN'], 400);
        }

        $unidad = (int)($data['unidad'] ?? 2);
        if (!in_array($unidad, [2, 3], true)) {
            $this->jsonResponse(['success' => false, 'message' => 'Unidad no válida'], 400);
        }

        try {
            if ($this->membershipModel->referenciaPagoExiste($referencia)) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Esa referencia ya fue registrada. Revisa tu comprobante o contacta a soporte.'
                ], 409);
            }

            $pagoId = $this->membershipModel->crearSolicitudPago($userId, $unidad, 1500.0, $metodoPago, $referencia);

            Logger::info('Solicitud de pago registrada pendiente de revisión', [
                'pago_id'    => $pagoId,
                'usuario_id' => $userId,
                'unidad'     => $unidad,
                'metodo'     => $metodoPago
            ]);

            $this->jsonResponse([
                'success' => true,
                'estado'  => 'pendiente',
                'pago_id' => $pagoId,
                'message' => 'Pago registrado. Un administrador debe confirmarlo antes de activar tu membresía.',
                'csrf_token' => Csrf::generateToken()
            ], 201);
        } catch (\Throwable $e) {
            Logger::error('Error al registrar solicitud de pago', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'No se pudo registrar tu pago. Intenta de nuevo.'], 500);
        }
    }
}
