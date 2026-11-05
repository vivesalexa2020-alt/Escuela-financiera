<?php
require_once 'conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

if (isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'loggedIn' => true,
        'user' => [
            'name' => $_SESSION['nombre'],
            'email' => $_SESSION['email']
        ]
    ]);
} else {
    echo json_encode(['loggedIn' => false]);
}
