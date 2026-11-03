<?php
require_once 'conexion.php';
require_once 'rate_limiter.php';
require_once 'csrf.php';

session_start();

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

// Validar CSRF token (excepto para login que no tiene sesión aún)
$csrfToken = $data['csrf_token'] ?? '';
if (!empty($csrfToken) && !validateCSRFToken($csrfToken)) {
    echo json_encode(['success' => false, 'message' => 'Error de validación CSRF. Recarga la página e intenta de nuevo.']);
    exit();
}

$email = strtolower(trim($data['email'] ?? ''));
$password = $data['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Correo y contraseña son obligatorios']);
    exit();
}

// Verificar rate limiting
$rateLimit = checkRateLimit($pdo, 'login', 5, 15);
if (!$rateLimit['permitido']) {
    logLoginAttempt($pdo, null, $email, false);
    echo json_encode(['success' => false, 'message' => $rateLimit['mensaje']]);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT id, nombre, password_hash FROM usuarios WHERE email = ? AND activo = 1 AND eliminado_en IS NULL");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    
    if (!$usuario || !password_verify($password, $usuario['password_hash'])) {
        logLoginAttempt($pdo, $usuario['id'] ?? null, $email, false);
        echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
        exit();
    }
    
    logLoginAttempt($pdo, $usuario['id'], $email, true);
    
    session_regenerate_id(true);
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['email'] = $email;
    
    $csrfToken = generateCSRFToken();
    
    echo json_encode([
        'success' => true,
        'message' => 'Inicio de sesión exitoso',
        'user' => [
            'name' => $usuario['nombre'],
            'email' => $email
        ],
        'csrf_token' => $csrfToken
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al iniciar sesión']);
}
