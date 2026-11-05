<?php
/**
 * Rutas API — endpoints JSON unificados a través del Router.
 * Recibe una instancia de Router y registra las rutas sobre ella.
 */

use App\Core\Router;
use App\Config\AppConfig;

return static function (Router $router): void {
    $cors = AppConfig::corsMiddleware();

    $router->group(['prefix' => 'api', 'middleware' => [$cors]], function (Router $r) {
        // ── Autenticación ─────────────────────────────────────
        $r->post('/login',            'AuthController@login');
        $r->post('/registro',         'AuthController@register');
        $r->post('/logout',           'AuthController@logout');
        $r->get('/session',           'AuthController@session');
        $r->post('/verificar-email',  'AuthController@verifyEmail');

        // ── Perfil de usuario ─────────────────────────────────
        $r->post('/actualizar-perfil', 'UserController@updateProfile');
        $r->post('/cambiar-password',  'UserController@changePassword');
        $r->post('/eliminar-cuenta',   'UserController@deleteAccount');

        // ── Cursos ────────────────────────────────────────────
        $r->get('/cursos',        'CourseController@index');
        $r->get('/cursos/{id}',   'CourseController@show');

        // ── Inscripciones ─────────────────────────────────────
        $r->get('/inscripciones',    'EnrollmentController@index');
        $r->post('/inscripciones',   'EnrollmentController@store');
        $r->delete('/inscripciones', 'EnrollmentController@destroy');

        // ── Progreso ──────────────────────────────────────────
        $r->get('/progreso',  'ProgressController@index');
        $r->post('/progreso', 'ProgressController@store');

        // ── Logros y puntos ───────────────────────────────────
        $r->get('/logros', 'AchievementController@index');

        // ── Membresía ─────────────────────────────────────────
        $r->get('/membresia', 'MembershipController@index');
    });
};
