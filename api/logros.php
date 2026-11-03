<?php
require_once 'conexion.php';
require_once 'logger.php';

session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit();
}

$usuarioId = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // Obtener puntos del usuario
        $stmt = $pdo->prepare("SELECT * FROM puntos_usuario WHERE usuario_id = ?");
        $stmt->execute([$usuarioId]);
        $puntos = $stmt->fetch();
        
        if (!$puntos) {
            // Crear registro de puntos si no existe
            $stmt = $pdo->prepare("INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) VALUES (?, 0, 1)");
            $stmt->execute([$usuarioId]);
            $puntos = ['puntos_totales' => 0, 'nivel' => 1];
        }
        
        // Obtener logros desbloqueados
        $stmt = $pdo->prepare("
            SELECT l.*, lu.fecha_desbloqueo 
            FROM logros_usuario lu 
            JOIN logros l ON lu.logro_id = l.id 
            WHERE lu.usuario_id = ?
        ");
        $stmt->execute([$usuarioId]);
        $logrosDesbloqueados = $stmt->fetchAll();
        
        // Obtener logros disponibles no desbloqueados
        $stmt = $pdo->prepare("
            SELECT l.* FROM logros l 
            WHERE l.activo = 1 
            AND l.id NOT IN (SELECT logro_id FROM logros_usuario WHERE usuario_id = ?)
        ");
        $stmt->execute([$usuarioId]);
        $logrosDisponibles = $stmt->fetchAll();
        
        echo json_encode([
            'success' => true,
            'puntos' => $puntos,
            'logros_desbloqueados' => $logrosDesbloqueados,
            'logros_disponibles' => $logrosDisponibles
        ]);
    } catch (PDOException $e) {
        Logger::error('Error al obtener logros', ['error' => $e->getMessage()]);
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al obtener logros']);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $logroId = $data['logro_id'] ?? null;
    
    if (!$logroId) {
        echo json_encode(['success' => false, 'message' => 'ID de logro es obligatorio']);
        exit();
    }
    
    try {
        // Verificar si el logro ya está desbloqueado
        $stmt = $pdo->prepare("SELECT id FROM logros_usuario WHERE usuario_id = ? AND logro_id = ?");
        $stmt->execute([$usuarioId, $logroId]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Logro ya desbloqueado']);
            exit();
        }
        
        // Desbloquear logro
        $stmt = $pdo->prepare("INSERT INTO logros_usuario (usuario_id, logro_id) VALUES (?, ?)");
        $stmt->execute([$usuarioId, $logroId]);
        
        // Obtener puntos del logro
        $stmt = $pdo->prepare("SELECT puntos_requeridos FROM logros WHERE id = ?");
        $stmt->execute([$logroId]);
        $logro = $stmt->fetch();
        
        if ($logro && $logro['puntos_requeridos'] > 0) {
            // Sumar puntos al usuario
            $stmt = $pdo->prepare("
                INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) 
                VALUES (?, ?, 1) 
                ON DUPLICATE KEY UPDATE 
                puntos_totales = puntos_totales + ?,
                nivel = FLOOR(puntos_totales / 500) + 1
            ");
            $stmt->execute([$usuarioId, $logro['puntos_requeridos']]);
        }
        
        Logger::info('Logro desbloqueado', ['usuario_id' => $usuarioId, 'logro_id' => $logroId]);
        
        echo json_encode(['success' => true, 'message' => 'Logro desbloqueado']);
    } catch (PDOException $e) {
        Logger::error('Error al desbloquear logro', ['error' => $e->getMessage()]);
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al desbloquear logro']);
    }
    exit();
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
