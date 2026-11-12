<?php
namespace App\Core;

abstract class Controller {
    public function __construct() {
        Session::start();
    }

    /**
     * Obtiene los datos del cuerpo de la petición (JSON o $_POST/$_GET)
     */
    protected function getRequestData(): array {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $rawInput = file_get_contents('php://input');

        if (stripos($contentType, 'application/json') !== false || !empty($rawInput)) {
            $jsonData = json_decode($rawInput, true);
            if (is_array($jsonData)) {
                return array_merge($_GET, $jsonData);
            }
        }

        return array_merge($_GET, $_POST);
    }

    /**
     * Emite una respuesta JSON estandarizada y finaliza la ejecución
     */
    protected function jsonResponse(array $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }

    /**
     * Verifica que el usuario haya iniciado sesión
     */
    protected function requireAuth(): int {
        $userId = Session::userId();
        if (!$userId) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'No autenticado. Por favor inicia sesión.'
            ], 401);
        }
        return (int)$userId;
    }

    /**
     * Devuelve el rol del usuario en sesión (estudiante por defecto)
     */
    protected function currentRole(): string {
        return Session::role();
    }

    /**
     * Exige que el usuario tenga uno de los roles indicados.
     * Acepta un rol (string) o una lista de roles (array).
     */
    protected function requireRole(string|array $roles): void {
        $roles = is_array($roles) ? $roles : [$roles];
        if (!in_array($this->currentRole(), $roles, true)) {
            $this->forbidden();
        }
    }

    /**
     * Atajo para exigir el rol de administrador
     */
    protected function requireAdmin(): void {
        $this->requireRole('admin');
    }

    /**
     * Responde 403 (JSON para peticiones API, HTML para páginas web)
     */
    protected function forbidden(string $message = 'No tienes permiso para acceder a esta sección.'): void {
        http_response_code(403);
        if ($this->wantsJson()) {
            $this->jsonResponse(['success' => false, 'message' => $message], 403);
        }

        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="utf-8">'
            . '<meta name="viewport" content="width=device-width, initial-scale=1.0">'
            . '<title>403 | Acceso denegado</title>'
            . '<style>body{font-family:system-ui,Arial,sans-serif;background:#0f172a;color:#e2e8f0;'
            . 'display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;text-align:center}'
            . 'a{color:#38bdf8}</style></head><body><div><h1>403</h1><p>'
            . htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
            . '</p><p><a href="index.php?page=home">Volver al inicio</a></p></div></body></html>';
        exit();
    }

    /**
     * Indica si la petición actual espera una respuesta JSON
     */
    protected function wantsJson(): bool {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($uri, '/api') !== false) {
            return true;
        }
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        if (stripos($accept, 'application/json') !== false) {
            return true;
        }
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        return stripos($contentType, 'application/json') !== false;
    }

    /**
     * Valida el token CSRF recibido en la petición
     */
    protected function validateCsrf(?string $token = null): void {
        if ($token === null) {
            $data = $this->getRequestData();
            $token = $data['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
        }

        if (!Csrf::validateToken($token)) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Error de validación de seguridad (CSRF). Por favor recarga la página.'
            ], 403);
        }
    }

    /**
     * Renderiza una vista MVC
     */
    protected function view(string $viewPath, array $data = [], ?string $layout = 'main'): void {
        View::render($viewPath, $data, $layout);
    }
}
