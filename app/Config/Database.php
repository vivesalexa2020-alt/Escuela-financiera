<?php
namespace App\Config;

use PDO;
use PDOException;
use App\Core\Logger;

class Database {
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $host = 'localhost';
            $dbname = 'educacion_financiera';
            $username = 'root';
            $password = '';

            $envFile = dirname(__DIR__, 2) . '/.env';
            if (file_exists($envFile)) {
                $env = parse_ini_file($envFile);
                if ($env) {
                    $host = $env['DB_HOST'] ?? $host;
                    $dbname = $env['DB_NAME'] ?? $dbname;
                    $username = $env['DB_USER'] ?? $username;
                    $password = $env['DB_PASSWORD'] ?? $password;
                }
            }

            try {
                $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                self::$instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                if (class_exists('App\Core\Logger')) {
                    Logger::error('Error de conexión a la base de datos', ['error' => $e->getMessage()]);
                }
                http_response_code(500);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode([
                    'success' => false,
                    'message' => 'Error de conexión con la base de datos'
                ]);
                exit();
            }
        }

        return self::$instance;
    }
}
