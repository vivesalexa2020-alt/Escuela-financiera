<?php
/**
 * ============================================================
 * EDUCACIÓN FINANCIERA - FRONT CONTROLLER WEB (MVC)
 * ============================================================
 */

require_once __DIR__ . '/autoload.php';

$router = require __DIR__ . '/routes/web.php';

// Despachar la ruta actual
$router->dispatch();
