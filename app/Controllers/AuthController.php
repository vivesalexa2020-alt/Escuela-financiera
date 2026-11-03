<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Core\RateLimiter;
use App\Core\Logger;
use App\Models\UserModel;

class AuthController extends Controller {
    private UserModel $userModel;
    private RateLimiter $rateLimiter;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->rateLimiter = new RateLimiter();
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $data = $this->getRequestData();

        // Validar CSRF token si se envió
        $csrfToken = $data['csrf_token'] ?? '';
        if (!empty($csrfToken) && !Csrf::validateToken($csrfToken)) {
            $this->jsonResponse([
                'success' => false, 
                'message' => 'Error de validación CSRF. Recarga la página e intenta de nuevo.'
            ], 403);
        }

        $email = strtolower(trim($data['email'] ?? ''));
        $password = $data['password'] ?? '';

        if (empty($email) || empty($password)) {
            $this->jsonResponse([
                'success' => false, 
                'message' => 'Correo y contraseña son obligatorios'
            ], 400);
        }

        // Rate limiting: 5 intentos cada 15 min
        $rateLimit = $this->rateLimiter->check('login', 5, 15);
        if (!$rateLimit['permitido']) {
            $this->userModel->logLoginAttempt(null, $email, false);
            $this->jsonResponse([
                'success' => false, 
                'message' => $rateLimit['mensaje']
            ], 429);
        }

        try {
            $usuario = $this->userModel->findByEmail($email);

            if (!$usuario || !password_verify($password, $usuario['password_hash'])) {
                $this->userModel->logLoginAttempt($usuario['id'] ?? null, $email, false);
                $this->jsonResponse([
                    'success' => false, 
                    'message' => 'Correo o contraseña incorrectos'
                ], 401);
            }

            $this->userModel->logLoginAttempt($usuario['id'], $email, true);

            Session::regenerateId(true);
            Session::set('usuario_id', $usuario['id']);
            Session::set('nombre', $usuario['nombre']);
            Session::set('email', $email);
            Session::set('rol', $usuario['rol'] ?? 'estudiante');

            $csrf = Csrf::generateToken();

            $this->jsonResponse([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'user' => [
                    'id'    => $usuario['id'],
                    'name'  => $usuario['nombre'],
                    'email' => $email,
                    'rol'   => $usuario['rol'] ?? 'estudiante'
                ],
                'email_verificado' => (bool)($usuario['email_verificado'] ?? false),
                'csrf_token' => $csrf
            ]);
        } catch (\Exception $e) {
            Logger::error('Excepción en login', ['error' => $e->getMessage()]);
            $this->jsonResponse([
                'success' => false, 
                'message' => 'Ocurrió un error inesperado al iniciar sesión'
            ], 500);
        }
    }

    public function register(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $data = $this->getRequestData();

        $nombre   = trim($data['nombre'] ?? '');
        $email    = strtolower(trim($data['email'] ?? ''));
        $password = $data['password'] ?? '';

        if (empty($nombre) || empty($email) || empty($password)) {
            $this->jsonResponse(['success' => false, 'message' => 'Todos los campos son obligatorios'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->jsonResponse(['success' => false, 'message' => 'Correo electrónico inválido'], 400);
        }

        if (strlen($password) < 8) {
            $this->jsonResponse(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres'], 400);
        }

        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $this->jsonResponse(['success' => false, 'message' => 'La contraseña debe incluir mayúscula, número y carácter especial'], 400);
        }

        // Rate limiting: 3 intentos cada 60 min
        $rateLimit = $this->rateLimiter->check('registro', 3, 60);
        if (!$rateLimit['permitido']) {
            $this->jsonResponse(['success' => false, 'message' => $rateLimit['mensaje']], 429);
        }

        try {
            if ($this->userModel->emailExists($email)) {
                $this->jsonResponse(['success' => false, 'message' => 'Ya existe una cuenta con ese correo electrónico'], 409);
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $tokenVerificacion = bin2hex(random_bytes(32));

            $usuarioId = $this->userModel->create($nombre, $email, $passwordHash, $tokenVerificacion);

            Session::regenerateId(true);
            Session::set('usuario_id', $usuarioId);
            Session::set('nombre', $nombre);
            Session::set('email', $email);

            $csrf = Csrf::generateToken();

            $this->jsonResponse([
                'success' => true,
                'message' => 'Cuenta creada exitosamente',
                'user' => [
                    'id'    => $usuarioId,
                    'name'  => $nombre,
                    'email' => $email
                ],
                'email_verificado' => false,
                'csrf_token' => $csrf
            ], 201);
        } catch (\Exception $e) {
            Logger::error('Excepción en registro', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al crear la cuenta'], 500);
        }
    }

    public function logout(): void {
        Session::destroy();
        $this->jsonResponse([
            'success' => true,
            'message' => 'Sesión cerrada exitosamente'
        ]);
    }

    public function session(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        if (Session::isLoggedIn()) {
            $this->jsonResponse([
                'loggedIn' => true,
                'user' => [
                    'id'    => Session::userId(),
                    'name'  => Session::get('nombre'),
                    'email' => Session::get('email')
                ],
                'csrf_token' => Csrf::generateToken()
            ]);
        } else {
            $this->jsonResponse(['loggedIn' => false]);
        }
    }

    public function verifyEmail(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $userId = $this->requireAuth();
        $data = $this->getRequestData();
        $token = trim($data['token'] ?? '');

        if (empty($token)) {
            $this->jsonResponse(['success' => false, 'message' => 'Token de verificación es obligatorio'], 400);
        }

        try {
            $ok = $this->userModel->verifyEmail($userId, $token);
            if (!$ok) {
                $this->jsonResponse(['success' => false, 'message' => 'Token de verificación inválido'], 400);
            }

            $this->jsonResponse([
                'success' => true,
                'message' => 'Email verificado correctamente'
            ]);
        } catch (\Exception $e) {
            Logger::error('Error al verificar email', ['error' => $e->getMessage()]);
            $this->jsonResponse(['success' => false, 'message' => 'Error al verificar email'], 500);
        }
    }
}
