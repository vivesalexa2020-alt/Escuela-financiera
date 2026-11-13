<?php
namespace App\Core;

class Router {
    private array $routes = [];
    private array $globalMiddleware = [];
    private string $groupPrefix = '';
    private array $groupMiddleware = [];

    // ── Métodos HTTP ──────────────────────────────────────────────

    public function get(string $path, string|callable $handler, array $middleware = []): void {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(string $path, string|callable $handler, array $middleware = []): void {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function put(string $path, string|callable $handler, array $middleware = []): void {
        $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function patch(string $path, string|callable $handler, array $middleware = []): void {
        $this->addRoute('PATCH', $path, $handler, $middleware);
    }

    public function delete(string $path, string|callable $handler, array $middleware = []): void {
        $this->addRoute('DELETE', $path, $handler, $middleware);
    }

    public function any(string $path, string|callable $handler, array $middleware = []): void {
        $this->addRoute('ANY', $path, $handler, $middleware);
    }

    // ── Middleware global ──────────────────────────────────────────

    public function middleware(callable $mw): void {
        $this->globalMiddleware[] = $mw;
    }

    // ── Grupos de rutas (con prefijo y middleware opcionales) ──────

    public function group(array $options, callable $callback): void {
        $prevPrefix     = $this->groupPrefix;
        $prevMiddleware = $this->groupMiddleware;

        $this->groupPrefix     .= '/' . trim($options['prefix'] ?? '', '/');
        $this->groupMiddleware  = array_merge($this->groupMiddleware, $options['middleware'] ?? []);

        $callback($this);

        $this->groupPrefix     = $prevPrefix;
        $this->groupMiddleware = $prevMiddleware;
    }

    // ── Registro interno ──────────────────────────────────────────

    private function addRoute(string $method, string $path, string|callable $handler, array $middleware): void {
        $fullPath = rtrim($this->groupPrefix, '/') . '/' . ltrim($path, '/');
        $fullPath = '/' . trim($fullPath, '/');
        if ($fullPath === '') {
            $fullPath = '/';
        }

        $this->routes[] = [
            'method'     => strtoupper($method),
            'path'       => $fullPath,
            'handler'    => $handler,
            'middleware'  => array_merge($this->groupMiddleware, $middleware),
            'paramNames' => $this->extractParamNames($fullPath),
            'regex'      => $this->pathToRegex($fullPath),
        ];
    }

    /** Convierte /cursos/{id} en una regex con grupos de captura */
    private function pathToRegex(string $path): string {
        $escaped = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '([^/]+)', $path);
        return '#^' . $escaped . '$#';
    }

    /** Extrae los nombres de los parámetros dinámicos */
    private function extractParamNames(string $path): array {
        preg_match_all('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', $path, $matches);
        return $matches[1];
    }

    // ── Despacho ──────────────────────────────────────────────────

    public function dispatch(?string $uri = null, ?string $method = null): void {
        $uri    = $uri    ?? parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $method = strtoupper($method ?? ($_SERVER['REQUEST_METHOD'] ?? 'GET'));

        $isApiEndpoint = isset($_GET['endpoint']);

        // Soporte de enrutamiento por query string: index.php?endpoint=login
        if ($isApiEndpoint) {
            $endpoint = trim((string)$_GET['endpoint'], '/');
            $uri      = '/api/' . $endpoint;
        } elseif (isset($_GET['page'])) {
            // Soporte de enrutamiento por query string: index.php?page=cursos
            $page = trim((string)$_GET['page'], '/');
            $uri  = '/' . ($page === '' ? '' : $page);
        }

        // Normalizar URI eliminando carpetas base si se ejecuta en subcarpetas
        if (!$isApiEndpoint) {
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
            if ($scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
                $uri = substr($uri, strlen($scriptDir));
            }
        }

        $uri = '/' . trim($uri, '/');
        if ($uri === '') {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== 'ANY' && $route['method'] !== $method) {
                continue;
            }

            $params = $this->matchRoute($uri, $route);
            if ($params !== null) {
                $allMiddleware = array_merge($this->globalMiddleware, $route['middleware']);
                $handler       = $route['handler'];

                $this->runMiddleware($allMiddleware, function () use ($handler, $params) {
                    $this->executeHandler($handler, $params);
                });
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

    /** Intenta hacer match de la URI contra una ruta; devuelve parámetros o null */
    private function matchRoute(string $uri, array $route): ?array {
        // Coincidencia comodín
        if ($route['path'] === '/*') {
            return [];
        }

        if (preg_match($route['regex'], $uri, $matches)) {
            array_shift($matches); // quitar el match completo
            $params = [];
            foreach ($route['paramNames'] as $i => $name) {
                $params[$name] = urldecode($matches[$i] ?? '');
            }
            return $params;
        }

        return null;
    }

    /** Ejecuta la cadena de middlewares y luego el handler final */
    private function runMiddleware(array $middleware, callable $final): void {
        if (empty($middleware)) {
            $final();
            return;
        }

        $mw   = array_shift($middleware);
        $next  = function () use ($middleware, $final) {
            $this->runMiddleware($middleware, $final);
        };

        $mw($next);
    }

    /** Ejecuta el handler (callable o string "Controller@method") */
    private function executeHandler(string|callable $handler, array $params = []): void {
        if (is_callable($handler)) {
            call_user_func_array($handler, $params);
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
                    call_user_func_array([$controller, $method], $params);
                    return;
                }
            }
        }

        throw new \RuntimeException("Controlador o método no encontrado: {$handler}");
    }
}
