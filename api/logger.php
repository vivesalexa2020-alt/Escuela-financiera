<?php
/**
 * Sistema de Logging
 * Registra errores, warnings y eventos importantes en archivos
 */

class Logger {
    private static $logDir;
    private static $instance = null;
    
    private function __construct() {
        self::$logDir = __DIR__ . '/logs';
        if (!is_dir(self::$logDir)) {
            mkdir(self::$logDir, 0755, true);
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Registrar error
     */
    public static function error($message, $context = []) {
        self::log('ERROR', $message, $context);
    }
    
    /**
     * Registrar warning
     */
    public static function warning($message, $context = []) {
        self::log('WARNING', $message, $context);
    }
    
    /**
     * Registrar info
     */
    public static function info($message, $context = []) {
        self::log('INFO', $message, $context);
    }
    
    /**
     * Registrar evento de seguridad
     */
    public static function security($message, $context = []) {
        self::log('SECURITY', $message, $context);
    }
    
    /**
     * Método principal de logging
     */
    private static function log($level, $message, $context = []) {
        $instance = self::getInstance();
        
        $date = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'CLI';
        $userId = $_SESSION['usuario_id'] ?? 'guest';
        
        $logEntry = sprintf(
            "[%s] [%s] [IP: %s] [User: %s] %s",
            $date,
            $level,
            $ip,
            $userId,
            $message
        );
        
        if (!empty($context)) {
            $logEntry .= ' | Context: ' . json_encode($context);
        }
        
        $logEntry .= PHP_EOL;
        
        // Determinar archivo según nivel
        $logFile = self::$logDir . '/' . strtolower($level) . '.log';
        
        // Rotar logs si son muy grandes (>10MB)
        if (file_exists($logFile) && filesize($logFile) > 10485760) {
            $backupFile = $logFile . '.' . date('Y-m-d-His') . '.bak';
            rename($logFile, $backupFile);
        }
        
        // Escribir al archivo
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * Registrar excepción
     */
    public static function exception($exception, $context = []) {
        $message = sprintf(
            "Exception: %s in %s:%d",
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );
        
        $context['trace'] = $exception->getTraceAsString();
        self::error($message, $context);
    }
}

/**
 * Manejador de errores personalizado
 */
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }
    
    $errorTypes = [
        E_ERROR => 'ERROR',
        E_WARNING => 'WARNING',
        E_PARSE => 'PARSE',
        E_NOTICE => 'NOTICE',
        E_CORE_ERROR => 'CORE_ERROR',
        E_CORE_WARNING => 'CORE_WARNING',
        E_COMPILE_ERROR => 'COMPILE_ERROR',
        E_COMPILE_WARNING => 'COMPILE_WARNING',
        E_USER_ERROR => 'USER_ERROR',
        E_USER_WARNING => 'USER_WARNING',
        E_USER_NOTICE => 'USER_NOTICE',
        E_STRICT => 'STRICT',
        E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
        E_DEPRECATED => 'DEPRECATED',
        E_USER_DEPRECATED => 'USER_DEPRECATED'
    ];
    
    $level = $errorTypes[$errno] ?? 'UNKNOWN';
    $message = "$errstr in $errfile:$errline";
    
    Logger::log($level, $message);
    
    // No ejecutar el manejador de errores interno de PHP
    return true;
});

/**
 * Manejador de excepciones no capturadas
 */
set_exception_handler(function($exception) {
    Logger::exception($exception);
    
    // En producción, mostrar página de error genérica
    if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error interno del servidor']);
    } else {
        // En desarrollo, mostrar detalles
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine()
        ]);
    }
});
