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
        $cursoId = $_GET['curso_id'] ?? null;
        
        if ($cursoId) {
            // Obtener progreso de un curso específico
            $stmt = $pdo->prepare("
                SELECT p.*, 
                       (SELECT COUNT(*) FROM lecciones WHERE curso_id = ? AND activo = 1) as total_lecciones
                FROM progreso_usuario p 
                WHERE p.usuario_id = ? AND p.curso_id = ?
            ");
            $stmt->execute([$cursoId, $usuarioId, $cursoId]);
            $progreso = $stmt->fetch();
            
            if (!$progreso) {
                echo json_encode(['success' => true, 'progreso' => null, 'completado' => false]);
            } else {
                echo json_encode(['success' => true, 'progreso' => $progreso]);
            }
        } else {
            // Obtener progreso de todos los cursos
            $stmt = $pdo->prepare("
                SELECT p.*, c.titulo as curso_titulo 
                FROM progreso_usuario p 
                JOIN cursos c ON p.curso_id = c.id 
                WHERE p.usuario_id = ?
            ");
            $stmt->execute([$usuarioId]);
            $progresos = $stmt->fetchAll();
            
            echo json_encode(['success' => true, 'progresos' => $progresos]);
        }
    } catch (PDOException $e) {
        Logger::error('Error al obtener progreso', ['error' => $e->getMessage()]);
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al obtener progreso']);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $cursoId = $data['curso_id'] ?? null;
    $leccionId = $data['leccion_id'] ?? null;
    $completado = $data['completado'] ?? 0;
    
    if (!$cursoId) {
        echo json_encode(['success' => false, 'message' => 'ID de curso es obligatorio']);
        exit();
    }
    
    try {
        // Verificar si ya existe progreso
        $stmt = $pdo->prepare("SELECT id FROM progreso_usuario WHERE usuario_id = ? AND curso_id = ?");
        $stmt->execute([$usuarioId, $cursoId]);
        $existente = $stmt->fetch();
        
        if ($existente) {
            // Actualizar progreso existente
            if ($leccionId) {
                $stmt = $pdo->prepare("
                    UPDATE progreso_usuario 
                    SET leccion_id = ?, completado = ?, fecha_actualizacion = NOW() 
                    WHERE usuario_id = ? AND curso_id = ?
                ");
                $stmt->execute([$leccionId, $completado, $usuarioId, $cursoId]);
            }
        } else {
            // Crear nuevo registro de progreso
            $stmt = $pdo->prepare("
                INSERT INTO progreso_usuario (usuario_id, curso_id, leccion_id, completado, fecha_inicio) 
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->execute([$usuarioId, $cursoId, $leccionId, $completado]);
        }
        
        // Calcular porcentaje de progreso
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM lecciones WHERE curso_id = ? AND activo = 1");
        $stmt->execute([$cursoId]);
        $totalLecciones = $stmt->fetchColumn();
        
        if ($totalLecciones > 0) {
            $stmt = $pdo->prepare("
                SELECT COUNT(*) FROM progreso_usuario 
                WHERE usuario_id = ? AND curso_id = ? AND completado = 1
            ");
            $stmt->execute([$usuarioId, $cursoId]);
            $leccionesCompletadas = $stmt->fetchColumn();
            
            $porcentaje = ($leccionesCompletadas / $totalLecciones) * 100;
            
            $stmt = $pdo->prepare("
                UPDATE progreso_usuario 
                SET porcentaje = ? 
                WHERE usuario_id = ? AND curso_id = ?
            ");
            $stmt->execute([$porcentaje, $usuarioId, $cursoId]);
            
            // Si completó el curso, marcar fecha de completado
            if ($porcentaje >= 100) {
                $stmt = $pdo->prepare("
                    UPDATE progreso_usuario 
                    SET fecha_completado = NOW() 
                    WHERE usuario_id = ? AND curso_id = ?
                ");
                $stmt->execute([$usuarioId, $cursoId]);
                
                // Otorgar puntos por completar curso
                $stmt = $pdo->prepare("
                    INSERT INTO puntos_usuario (usuario_id, puntos_totales, nivel) 
                    VALUES (?, 100, 1) 
                    ON DUPLICATE KEY UPDATE 
                    puntos_totales = puntos_totales + 100,
                    nivel = FLOOR(puntos_totales / 500) + 1
                ");
                $stmt->execute([$usuarioId]);
                
                Logger::info('Curso completado', ['usuario_id' => $usuarioId, 'curso_id' => $cursoId]);
            }
        }
        
        echo json_encode(['success' => true, 'message' => 'Progreso actualizado']);
    } catch (PDOException $e) {
        Logger::error('Error al actualizar progreso', ['error' => $e->getMessage()]);
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al actualizar progreso']);
    }
    exit();
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
