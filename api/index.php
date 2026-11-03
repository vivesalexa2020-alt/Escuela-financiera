<?php
/**
 * ============================================================
 * EDUCACIÓN FINANCIERA - FRONT CONTROLLER API (MVC REST)
 * ============================================================
 */

require_once __DIR__ . '/../autoload.php';

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

$dispatchApiRoute = require __DIR__ . '/../routes/api.php';
$dispatchApiRoute($endpoint);
