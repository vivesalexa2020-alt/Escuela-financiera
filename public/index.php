<?php
/**
 * Front Controller unificado de Educación Financiera.
 * Carga todas las rutas (web + API) y despacha en un solo Router.
 */

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
define('APP_DIRECT_PUBLIC_ENTRY', str_contains($scriptName, '/public/'));

require_once dirname(__DIR__) . '/autoload.php';

use App\Core\Router;
use App\Core\ErrorHandler;

// Evitar caché heurística del HTML en los navegadores (vista siempre fresca)
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

// Registrar manejo global de errores
ErrorHandler::register();

$router = new Router();

// Cargar rutas web y API
(require dirname(__DIR__) . '/routes/web.php')($router);
(require dirname(__DIR__) . '/routes/api.php')($router);

$router->dispatch();
