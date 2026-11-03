<?php
namespace App\Core;

class ErrorHandler {
    /**
     * Registra los handlers globales de errores y excepciones
     */
    public static function register(): void {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    /**
     * Convierte errores PHP en excepciones
     */
    public static function handleError(int $severity, string $message, string $file, int $line): bool {
        if (!(error_reporting() & $severity)) {
            return false;
        }
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    /**
     * Maneja excepciones no capturadas
     */
    public static function handleException(\Throwable $e): void {
        Logger::error('Excepción no capturada', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'trace'   => $e->getTraceAsString(),
        ]);

        if (headers_sent()) {
            return;
        }

        http_response_code(500);

        $isApi = strpos($_SERVER['REQUEST_URI'] ?? '', '/api') === 0
              || ($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json';

        if ($isApi) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'success' => false,
                'message' => 'Error interno del servidor',
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo '<h1>500 Error Interno</h1>';
            echo '<p>Ocurrió un error inesperado. Por favor intenta más tarde.</p>';
        }
    }

    /**
     * Detecta errores fatales al finalizar la ejecución
     */
    public static function handleShutdown(): void {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
            self::handleException(
                new \ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line'])
            );
        }
    }
}
