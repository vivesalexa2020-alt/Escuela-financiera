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
$token = trim($data['token'] ?? '');

if (empty($token)) {
    echo json_encode(['success' => false, 'message' => 'Token de verificación es obligatorio']);
    exit();
}

try {
    $usuarioId = $_SESSION['usuario_id'];

    // Verificar token del usuario
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE id = ? AND token_verificacion = ? AND eliminado_en IS NULL");
    $stmt->execute([$usuarioId, $token]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        echo json_encode(['success' => false, 'message' => 'Token de verificación inválido']);
        exit();
    }

    // Marcar email como verificado
    $stmt = $pdo->prepare("UPDATE usuarios SET email_verificado = 1, token_verificacion = NULL WHERE id = ?");
    $stmt->execute([$usuarioId]);

    echo json_encode([
        'success' => true,
        'message' => 'Email verificado correctamente'
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al verificar email']);
}
