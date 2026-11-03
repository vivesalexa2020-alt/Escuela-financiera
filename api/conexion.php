<?php
/**
 * Adaptador de compatibilidad para conexion.php hacia App\Config\Database
 */
require_once __DIR__ . '/../autoload.php';

use App\Config\Database;
use App\Config\AppConfig;
use App\Core\Session;

AppConfig::initCors();
Session::start();

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getConnection();
