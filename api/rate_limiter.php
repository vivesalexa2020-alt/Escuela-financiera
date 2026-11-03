<?php
/**
 * Adaptador de compatibilidad para rate_limiter.php hacia App\Core\RateLimiter
 */
require_once __DIR__ . '/../autoload.php';

use App\Core\RateLimiter;
use App\Config\Database;

function checkRateLimit($pdo, $accion, $maxIntentos = 5, $ventanaMinutos = 15): array {
    $limiter = new RateLimiter($pdo);
    return $limiter->check($accion, $maxIntentos, $ventanaMinutos);
}
