<?php
namespace App\Core;

class Logger {
    private static ?string $logDir = null;

    private static function init(): void {
        if (self::$logDir === null) {
            self::$logDir = dirname(__DIR__, 2) . '/api/logs';
            if (!is_dir(self::$logDir)) {
                mkdir(self::$logDir, 0755, true);
            }
        }
    }

    public static function error(string $message, array $context = []): void {
        self::log('ERROR', $message, $context);
    }

    public static function warning(string $message, array $context = []): void {
        self::log('WARNING', $message, $context);
    }

    public static function info(string $message, array $context = []): void {
        self::log('INFO', $message, $context);
    }

    public static function security(string $message, array $context = []): void {
        self::log('SECURITY', $message, $context);
    }

    private static function log(string $level, string $message, array $context = []): void {
        self::init();

        $date = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'CLI';
        $userId = $_SESSION['usuario_id'] ?? 'invitado';

        $entry = sprintf(
            "[%s] [%s] [IP: %s] [User: %s] %s %s\n",
            $date,
            $level,
            $ip,
            $userId,
            $message,
            !empty($context) ? json_encode($context, JSON_UNESCAPED_UNICODE) : ''
        );

        $filename = self::$logDir . '/' . strtolower($level) . '_' . date('Y-m-d') . '.log';
        file_put_contents($filename, $entry, FILE_APPEND | LOCK_EX);
    }
}
