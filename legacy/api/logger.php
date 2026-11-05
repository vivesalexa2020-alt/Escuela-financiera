<?php
/**
 * Adaptador de compatibilidad para logger.php hacia App\Core\Logger
 */
require_once __DIR__ . '/../autoload.php';

use App\Core\Logger;

// La clase Logger del namespace App\Core se carga automáticamente.
// Funciones wrapper de compatibilidad para código legacy que usa funciones sueltas:

function logLoginAttempt($pdo, ?int $userId, string $email, bool $exitoso): void {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    try {
        $stmt = $pdo->prepare("
            INSERT INTO login_logs (usuario_id, email_ingresado, ip_address, user_agent, exitoso) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$userId, $email, $ip, $userAgent, $exitoso ? 1 : 0]);
    } catch (\Exception $e) {
        // Silencioso para no interrumpir el flujo
    }

    $message = $exitoso ? 'Login exitoso' : 'Login fallido';
    $context = ['email' => $email, 'ip' => $ip];

    if ($exitoso) {
        Logger::info($message, $context);
    } else {
        Logger::warning($message, $context);
    }
}
