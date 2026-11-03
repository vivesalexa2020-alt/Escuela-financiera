<?php
require_once 'conexion.php';
require_once 'csrf.php';

session_start();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit();
}

// Validar CSRF token
$csrfToken = $data['csrf_token'] ?? '';
if (!validateCSRFToken($csrfToken)) {
    echo json_encode(['success' => false, 'message' => 'Error de validación CSRF. Recarga la página e intenta de nuevo.']);
    exit();
}

$usuarioId = $_SESSION['usuario_id'];

try {
    // Soft delete: marcar como eliminado en lugar de borrar
    $stmt = $pdo->prepare("UPDATE usuarios SET activo = 0, eliminado_en = NOW() WHERE id = ?");
    $stmt->execute([$usuarioId]);

    // Registrar en auditoría
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $stmt = $pdo->prepare("INSERT INTO cambios_perfil (usuario_id, campo_cambiado, valor_anterior, valor_nuevo, ip_address) VALUES (?, 'cuenta_eliminada', 'activa', 'eliminada', ?)");
    $stmt->execute([$usuarioId, $ip]);

    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    echo json_encode(['success' => true, 'message' => 'Cuenta eliminada. Se mantendrán los datos por 30 días por seguridad.']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al eliminar la cuenta']);
}
