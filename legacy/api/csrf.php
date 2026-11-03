<?php
/**
 * Adaptador de compatibilidad para CSRF hacia App\Core\Csrf
 */
require_once __DIR__ . '/../autoload.php';

use App\Core\Csrf;

function generateCSRFToken(): string {
    return Csrf::generateToken();
}

function validateCSRFToken($token): bool {
    return Csrf::validateToken($token);
}

function getCSRFTokenForResponse(): array {
    return ['csrf_token' => Csrf::getToken()];
}
