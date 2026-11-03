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

    // Obtener datos actuales para auditoría
    $stmt = $pdo->prepare("SELECT nombre, email FROM usuarios WHERE id = ?");
    $stmt->execute([$usuarioId]);
    $usuarioActual = $stmt->fetch();

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

    // Registrar cambios en auditoría
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    
    if ($usuarioActual['nombre'] !== $nombre) {
        $stmt = $pdo->prepare("INSERT INTO cambios_perfil (usuario_id, campo_cambiado, valor_anterior, valor_nuevo, ip_address) VALUES (?, 'nombre', ?, ?, ?)");
        $stmt->execute([$usuarioId, $usuarioActual['nombre'], $nombre, $ip]);
    }
    
    if ($usuarioActual['email'] !== $email) {
        $stmt = $pdo->prepare("INSERT INTO cambios_perfil (usuario_id, campo_cambiado, valor_anterior, valor_nuevo, ip_address) VALUES (?, 'email', ?, ?, ?)");
        $stmt->execute([$usuarioId, $usuarioActual['email'], $email, $ip]);
    }

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
