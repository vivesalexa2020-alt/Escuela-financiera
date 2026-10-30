<?php
require_once 'conexion.php';

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

$data = json_decode(file_get_contents('php://input'), true);
$passwordActual  = $data['password_actual']  ?? '';
$passwordNueva   = $data['password_nueva']   ?? '';

if (empty($passwordActual) || empty($passwordNueva)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit();
}

// Validar complejidad de la nueva contraseña
if (strlen($passwordNueva) < 8) {
    echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres']);
    exit();
}
if (!preg_match('/[A-Z]/', $passwordNueva) || !preg_match('/[0-9]/', $passwordNueva) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $passwordNueva)) {
    echo json_encode(['success' => false, 'message' => 'La contraseña debe incluir mayúscula, número y carácter especial']);
    exit();
}

try {
    $usuarioId = $_SESSION['usuario_id'];

    // Obtener el hash actual del usuario
    $stmt = $pdo->prepare("SELECT password_hash FROM usuarios WHERE id = ? AND activo = 1");
    $stmt->execute([$usuarioId]);
    $usuario = $stmt->fetch();

    if (!$usuario || !password_verify($passwordActual, $usuario['password_hash'])) {
        echo json_encode(['success' => false, 'message' => 'Tu contraseña actual no es correcta']);
        exit();
    }

    // Actualizar con el nuevo hash
    $nuevoHash = password_hash($passwordNueva, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE usuarios SET password_hash = ? WHERE id = ?");
    $stmt->execute([$nuevoHash, $usuarioId]);

    echo json_encode(['success' => true, 'message' => 'Contraseña actualizada correctamente']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la contraseña']);
}
