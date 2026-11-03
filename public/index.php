<?php
/**
 * Front controller web de Educación Financiera.
 */
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
define('APP_DIRECT_PUBLIC_ENTRY', str_contains($scriptName, '/public/'));

require_once dirname(__DIR__) . '/autoload.php';

$router = require dirname(__DIR__) . '/routes/web.php';
$router->dispatch();
