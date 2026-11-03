<?php
/**
 * ============================================================
 * EDUCACIÓN FINANCIERA - FRONT CONTROLLER API (MVC REST)
 * ============================================================
 */

require_once __DIR__ . '/../autoload.php';

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\CourseController;
use App\Controllers\EnrollmentController;
use App\Controllers\ProgressController;
use App\Controllers\AchievementController;
use App\Controllers\MembershipController;

// Obtener el endpoint solicitado (por parámetro ?endpoint= o por URI)
$endpoint = $_GET['endpoint'] ?? null;

if (!$endpoint) {
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    if ($scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
        $uri = substr($uri, strlen($scriptDir));
    }
    $parts = explode('/', trim($uri, '/'));
    // Si la URI es /api/login o similar, tomar el último segmento
    $endpoint = end($parts);
    $endpoint = str_replace('.php', '', $endpoint);
}

match ($endpoint) {
    'login'             => (new AuthController())->login(),
    'registro'          => (new AuthController())->register(),
    'logout'            => (new AuthController())->logout(),
    'session'           => (new AuthController())->session(),
    'verificar-email'   => (new AuthController())->verifyEmail(),
    'actualizar-perfil' => (new UserController())->updateProfile(),
    'cambiar-password'  => (new UserController())->changePassword(),
    'eliminar-cuenta'   => (new UserController())->deleteAccount(),
    'cursos'            => (isset($_GET['id']) ? (new CourseController())->show($_GET['id']) : (new CourseController())->index()),
    'inscripciones'     => (new EnrollmentController())->handle(),
    'progreso'          => (new ProgressController())->handle(),
    'logros'            => (new AchievementController())->index(),
    'membresia'         => (new MembershipController())->index(),
    default             => (function() {
        http_response_code(404);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'message' => 'Endpoint API no encontrado']);
    })()
};
