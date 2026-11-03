<?php
namespace App\Config;

class AppConfig {
    public const APP_NAME = 'Educación Financiera';
    public const APP_VERSION = '2.0.0';

    /**
     * Configuración de CORS y cabeceras de respuesta
     */
    public static function initCors(): void {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        if (!empty($origin)) {
            if (preg_match('/^https?:\/\/(localhost|127\.0\.0\.1)(:[0-9]+)?$/', $origin)) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Credentials: true');
            }
        } else {
            header('Access-Control-Allow-Credentials: true');
        }

        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
            http_response_code(204);
            exit();
        }
    }
}
