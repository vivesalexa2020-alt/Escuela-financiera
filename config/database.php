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
            $envFile = dirname(__DIR__) . '/.env';
            if (!file_exists($envFile)) {
                throw new \RuntimeException(
                    'Archivo .env no encontrado. Copia .env.example a .env y configura tus credenciales.'
                );
            }

            $env = parse_ini_file($envFile);
            if (!$env) {
                throw new \RuntimeException('No se pudo leer el archivo .env');
            }

            $host     = $env['DB_HOST']     ?? 'localhost';
            $dbname   = $env['DB_NAME']     ?? '';
            $username = $env['DB_USER']     ?? '';
            $password = $env['DB_PASSWORD'] ?? '';

            if (empty($dbname)) {
                throw new \RuntimeException('DB_NAME no está definido en el archivo .env');
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
