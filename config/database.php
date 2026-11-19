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
            if ($env === false) {
                throw new \RuntimeException('No se pudo leer el archivo .env (error de formato)');
            }

            $host     = $env['DB_HOST']     ?? 'localhost';
            $port     = $env['DB_PORT']     ?? '3306';
            $dbname   = $env['DB_NAME']     ?? '';
            $username = $env['DB_USER']     ?? '';
            $password = $env['DB_PASSWORD'] ?? '';

            if (empty($dbname)) {
                throw new \RuntimeException('DB_NAME no está definido en el archivo .env');
            }

            try {
                $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
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

                $isApi = (
                    stripos($_SERVER['REQUEST_URI'] ?? '', '/api') !== false ||
                    stripos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false
                );

                http_response_code(500);

                if ($isApi) {
                    if (!headers_sent()) {
                        header('Content-Type: application/json; charset=utf-8');
                    }
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error de conexión con la base de datos'
                    ]);
                    exit();
                }

                if (!headers_sent()) {
                    header('Content-Type: text/html; charset=utf-8');
                }
                echo "<!DOCTYPE html><html lang='es'><head><meta charset='utf-8'><title>Error del Servidor</title></head><body>";
                echo "<h1>Error 500: Servicio Temporalmente No Disponible</h1>";
                echo "<p>No fue posible conectar con la base de datos. Por favor, inténtelo de nuevo más tarde.</p>";
                echo "</body></html>";
                exit();
            }
        }

        return self::$instance;
    }
}
