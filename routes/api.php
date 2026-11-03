<?php

use App\Controllers\AchievementController;
use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\EnrollmentController;
use App\Controllers\MembershipController;
use App\Controllers\ProgressController;
use App\Controllers\UserController;

return static function (string $endpoint): void {
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
        'progreso'           => (new ProgressController())->handle(),
        'logros'             => (new AchievementController())->index(),
        'membresia'           => (new MembershipController())->index(),
        default              => (function() {
            http_response_code(404);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Endpoint API no encontrado']);
        })()
    };
};
