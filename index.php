<?php
/**
 * ============================================================
 * EDUCACIÓN FINANCIERA - FRONT CONTROLLER WEB (MVC)
 * ============================================================
 */

require_once __DIR__ . '/autoload.php';

use App\Core\Router;
use App\Controllers\PageController;

// Soporte para parámetro query ?page=...
$page = $_GET['page'] ?? null;
if ($page !== null) {
    $pageController = new PageController();
    match ($page) {
        'cursos'          => $pageController->cursos(),
        'aula'            => $pageController->aula(),
        'recursos'        => $pageController->recursos(),
        'reticula'        => $pageController->reticula(),
        'metas'           => $pageController->metas(),
        'configuraciones' => $pageController->configuraciones(),
        'suscripcion'     => $pageController->suscripcion(),
        default           => $pageController->home(),
    };
    exit();
}

$router = new Router();

// Rutas Web
$router->get('/', 'PageController@home');
$router->get('/index.php', 'PageController@home');
$router->get('/cursos', 'PageController@cursos');
$router->get('/aula', 'PageController@aula');
$router->get('/recursos', 'PageController@recursos');
$router->get('/reticula', 'PageController@reticula');
$router->get('/metas', 'PageController@metas');
$router->get('/configuraciones', 'PageController@configuraciones');
$router->get('/suscripcion', 'PageController@suscripcion');

// Despachar la ruta actual
$router->dispatch();
