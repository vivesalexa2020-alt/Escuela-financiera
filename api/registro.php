<?php
require_once 'conexion.php';

session_start();

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

$nombre = trim($data['nombre'] ?? '');
$email = strtolower(trim($data['email'] ?? ''));
$password = $data['password'] ?? '';

if (empty($nombre) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Correo electrónico inválido']);
    exit();
}

if (strlen($password) < 8) {
    echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres']);
    exit();
}
// Validar complejidad: mayúscula, número y carácter especial
if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
    echo json_encode(['success' => false, 'message' => 'La contraseña debe incluir mayúscula, número y carácter especial']);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Ya existe una cuenta con ese correo electrónico']);
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    $pdo->beginTransaction();
    
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password_hash) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $email, $passwordHash]);
    $usuarioId = $pdo->lastInsertId();
    
    $stmt = $pdo->prepare("INSERT INTO membresias (usuario_id, activa, tipo_membresia) VALUES (?, 1, 'gratis')");
    $stmt->execute([$usuarioId]);
    
    $pdo->commit();
    
    session_regenerate_id(true);
    $_SESSION['usuario_id'] = $usuarioId;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['email'] = $email;
    
    echo json_encode([
        'success' => true,
        'message' => 'Cuenta creada exitosamente',
        'user' => [
            'name' => $nombre,
            'email' => $email
        ]
    ]);
} catch (PDOException $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al crear la cuenta']);
}
