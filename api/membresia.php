<?php
require_once 'conexion.php';

session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit();
}

$usuarioId = $_SESSION['usuario_id'];

try {
    $stmt = $pdo->prepare("SELECT activa, tipo_membresia, fecha_inicio, fecha_vencimiento FROM membresias WHERE usuario_id = ?");
    $stmt->execute([$usuarioId]);
    $membresia = $stmt->fetch();
    
    if (!$membresia) {
        $stmt = $pdo->prepare("INSERT INTO membresias (usuario_id) VALUES (?)");
        $stmt->execute([$usuarioId]);
        $membresia = ['activa' => 1, 'tipo_membresia' => 'gratis', 'fecha_inicio' => date('Y-m-d H:i:s'), 'fecha_vencimiento' => null];
    }
    
    echo json_encode(['success' => true, 'membresia' => $membresia]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al obtener membresía']);
}
