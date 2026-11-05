<?php
/**
 * Punto de entrada API de Educación Financiera.
 * Usa el mismo Router unificado; solo registra las rutas API.
 */

require_once __DIR__ . '/../autoload.php';

use App\Core\Router;
use App\Core\ErrorHandler;

ErrorHandler::register();

$router = new Router();

// Solo cargar rutas API
(require __DIR__ . '/../routes/api.php')($router);

$router->dispatch();
