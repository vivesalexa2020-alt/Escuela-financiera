<?php
require_once 'conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit();
}

session_destroy();
echo json_encode(['success' => true, 'message' => 'Sesión cerrada']);
