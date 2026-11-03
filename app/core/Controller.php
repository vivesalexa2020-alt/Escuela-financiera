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
