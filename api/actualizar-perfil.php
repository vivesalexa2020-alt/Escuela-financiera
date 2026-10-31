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
$nombre = trim($data['nombre'] ?? '');
$email  = strtolower(trim($data['email'] ?? ''));

if (empty($nombre) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'El nombre y el correo son obligatorios']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Correo electrónico inválido']);
    exit();
}

try {
    $usuarioId = $_SESSION['usuario_id'];

    // Comprobar si el correo ya está registrado por otro usuario
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
    $stmt->execute([$email, $usuarioId]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico ya está registrado por otra cuenta']);
        exit();
    }

    // Actualizar nombre y correo
    $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
    $stmt->execute([$nombre, $email, $usuarioId]);

    $_SESSION['nombre'] = $nombre;
    $_SESSION['email']  = $email;

    echo json_encode([
        'success' => true,
        'message' => 'Perfil actualizado correctamente',
        'user'    => [
            'name'  => $nombre,
            'email' => $email
        ]
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil']);
}
