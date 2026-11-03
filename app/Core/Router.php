<?php
namespace App\Core;

class Router {
    private array $routes = [];

    public function get(string $path, string|callable $handler): void {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, string|callable $handler): void {
        $this->addRoute('POST', $path, $handler);
    }

    public function delete(string $path, string|callable $handler): void {
        $this->addRoute('DELETE', $path, $handler);
    }

    public function any(string $path, string|callable $handler): void {
        $this->addRoute('ANY', $path, $handler);
    }

    private function addRoute(string $method, string $path, string|callable $handler): void {
        $this->routes[] = [
            'method'  => strtoupper($method),
            'path'    => '/' . trim($path, '/'),
            'handler' => $handler,
        ];
    }

    public function dispatch(?string $uri = null, ?string $method = null): void {
        $uri = $uri ?? parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $method = strtoupper($method ?? ($_SERVER['REQUEST_METHOD'] ?? 'GET'));

        // Soporte de enrutamiento por query string: index.php?page=cursos
        if (isset($_GET['page'])) {
            $page = trim((string)$_GET['page'], '/');
            $uri = '/' . ($page === '' ? '' : $page);
        }

        // Normalizar URI eliminando carpetas base si se ejecuta en subcarpetas
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        if ($scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
            $uri = substr($uri, strlen($scriptDir));
        }

        $uri = '/' . trim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== 'ANY' && $route['method'] !== $method) {
                continue;
            }

            // Coincidencia exacta o comodín
            if ($route['path'] === $uri || $route['path'] === '/*') {
                $this->executeHandler($route['handler']);
                return;
            }
        }

        // Si no se encontró ninguna ruta
        http_response_code(404);
        if (strpos($uri, '/api') === 0 || ($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json') {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Ruta no encontrada']);
        } else {
            echo "<h1>404 Not Found</h1><p>La ruta '{$uri}' no existe en esta aplicación.</p>";
        }
    }

    private function executeHandler(string|callable $handler): void {
        if (is_callable($handler)) {
            call_user_func($handler);
            return;
        }

        if (is_string($handler) && strpos($handler, '@') !== false) {
            [$controllerName, $method] = explode('@', $handler);
            $fullClass = strpos($controllerName, '\\') === false 
                ? "App\\Controllers\\{$controllerName}" 
                : $controllerName;

            if (class_exists($fullClass)) {
                $controller = new $fullClass();
                if (method_exists($controller, $method)) {
                    $controller->$method();
                    return;
                }
            }
        }

        throw new \RuntimeException("Controlador o método no encontrado: {$handler}");
    }
}
