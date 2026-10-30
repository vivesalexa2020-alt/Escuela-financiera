<?php
require_once 'conexion.php';

session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit();
}

$usuarioId = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT materia_id, semestre FROM inscripciones WHERE usuario_id = ?");
        $stmt->execute([$usuarioId]);
        $inscripciones = $stmt->fetchAll();
        
        $materias = array_map(function($row) {
            return $row['materia_id'];
        }, $inscripciones);
        
        echo json_encode(['success' => true, 'inscritas' => $materias]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al obtener inscripciones']);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $materiaId = trim($data['materia_id'] ?? '');
    $semestre = intval($data['semestre'] ?? 0);

    // Validar que el semestre esté entre 1 y 4
    if ($semestre < 1 || $semestre > 4) {
        echo json_encode(['success' => false, 'message' => 'El semestre debe estar entre 1 y 4']);
        exit();
    }

    if (empty($materiaId) || $semestre < 1) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO inscripciones (usuario_id, materia_id, semestre) VALUES (?, ?, ?)");
        $stmt->execute([$usuarioId, $materiaId, $semestre]);

        echo json_encode(['success' => true, 'message' => 'Inscripción exitosa']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al inscribir']);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $materiaId = $data['materia_id'] ?? '';
    
    if (empty($materiaId)) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit();
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM inscripciones WHERE usuario_id = ? AND materia_id = ?");
        $stmt->execute([$usuarioId, $materiaId]);
        
        echo json_encode(['success' => true, 'message' => 'Inscripción eliminada']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error eliminar inscripción']);
    }
    exit();
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
