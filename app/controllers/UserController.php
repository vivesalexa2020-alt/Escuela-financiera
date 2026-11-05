<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Logger;
use App\Models\UserModel;

class UserController extends Controller {
    private UserModel $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function updateProfile(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $this->validateCsrf($data['csrf_token'] ?? null);

        $nombre = trim($data['nombre'] ?? '');
        $email  = strtolower(trim($data['email'] ?? ''));

        if (empty($nombre) || empty($email)) {
            $this->jsonResponse(['success' => false, 'message' => 'El nombre y el correo son obligatorios'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->jsonResponse(['success' => false, 'message' => 'Correo electrónico inválido'], 400);
        }

        try {
            if ($this->userModel->emailExists($email, $userId)) {
                $this->jsonResponse([
                    'success' => false, 
                    'message' => 'El correo electrónico ya está registrado por otra cuenta'
                ], 409);
            }

            $this->userModel->updateProfile($userId, $nombre, $email);

            Session::set('nombre', $nombre);
            Session::set('email', $email);

            $this->jsonResponse([
                'success' => true,
                'message' => 'Perfil actualizado correctamente',
                'user' => [
                    'id'    => $userId,
                    'name'  => $nombre,
                    'email' => $email
                ]
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar perfil', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al actualizar el perfil'], 500);
        }
    }

    public function changePassword(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $this->validateCsrf($data['csrf_token'] ?? null);

        $passwordActual = $data['password_actual'] ?? '';
        $passwordNueva  = $data['password_nueva'] ?? '';

        if (empty($passwordActual) || empty($passwordNueva)) {
            $this->jsonResponse(['success' => false, 'message' => 'Todos los campos son obligatorios'], 400);
        }

        if (strlen($passwordNueva) < 8) {
            $this->jsonResponse(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres'], 400);
        }

        if (!preg_match('/[A-Z]/', $passwordNueva) || !preg_match('/[0-9]/', $passwordNueva) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $passwordNueva)) {
            $this->jsonResponse(['success' => false, 'message' => 'La contraseña debe incluir mayúscula, número y carácter especial'], 400);
        }

        try {
            $usuario = $this->userModel->findById($userId);
            // Necesitamos el hash actual
            $userWithHash = $this->userModel->findByEmail($usuario['email']);

            if (!$userWithHash || !password_verify($passwordActual, $userWithHash['password_hash'])) {
                $this->jsonResponse(['success' => false, 'message' => 'Tu contraseña actual no es correcta'], 400);
            }

            $nuevoHash = password_hash($passwordNueva, PASSWORD_DEFAULT);
            $this->userModel->updatePassword($userId, $nuevoHash);

            $this->jsonResponse([
                'success' => true,
                'message' => 'Contraseña actualizada exitosamente'
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al cambiar contraseña', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al cambiar contraseña'], 500);
        }
    }

    public function deleteAccount(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();
        $data = $this->getRequestData();

        $this->validateCsrf($data['csrf_token'] ?? null);

        try {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $this->userModel->softDelete($userId, $ip);

            Session::destroy();

            $this->jsonResponse([
                'success' => true,
                'message' => 'Cuenta eliminada. Se mantendrán los datos por 30 días por seguridad.'
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar cuenta', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al eliminar la cuenta'], 500);
        }
    }
}
