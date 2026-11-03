<?php
require_once 'conexion.php';
require_once 'logger.php';

session_start();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $cursoId = $_GET['id'] ?? null;
        
        if ($cursoId) {
            // Obtener curso específico con sus recursos completos
            $stmt = $pdo->prepare("
                SELECT c.*, 
                       (SELECT COUNT(*) FROM lecciones WHERE curso_id = c.id AND activo = 1) as total_lecciones,
                       (SELECT COUNT(*) FROM ejercicios WHERE curso_id = c.id AND activo = 1) as total_ejercicios,
                       (SELECT COUNT(*) FROM audios WHERE curso_id = c.id AND activo = 1) as total_audios,
                       (SELECT COUNT(*) FROM libros WHERE curso_id = c.id AND activo = 1) as total_libros
                FROM cursos c 
                WHERE c.id = ? AND c.activo = 1
            ");
            $stmt->execute([$cursoId]);
            $curso = $stmt->fetch();
            
            if (!$curso) {
                echo json_encode(['success' => false, 'message' => 'Curso no encontrado']);
                exit();
            }
            
            // Obtener lecciones (videos)
            $stmt = $pdo->prepare("SELECT * FROM lecciones WHERE curso_id = ? AND activo = 1 ORDER BY orden");
            $stmt->execute([$cursoId]);
            $curso['lecciones'] = $stmt->fetchAll();

            // Obtener ejercicios
            $stmt = $pdo->prepare("SELECT * FROM ejercicios WHERE curso_id = ? AND activo = 1 ORDER BY orden");
            $stmt->execute([$cursoId]);
            $curso['ejercicios'] = $stmt->fetchAll();

            // Obtener audios
            $stmt = $pdo->prepare("SELECT * FROM audios WHERE curso_id = ? AND activo = 1 ORDER BY orden");
            $stmt->execute([$cursoId]);
            $curso['audios'] = $stmt->fetchAll();

            // Obtener libros
            $stmt = $pdo->prepare("SELECT * FROM libros WHERE curso_id = ? AND activo = 1 ORDER BY orden");
            $stmt->execute([$cursoId]);
            $curso['libros'] = $stmt->fetchAll();
            
            echo json_encode(['success' => true, 'curso' => $curso]);
        } else {
            // Listar todos los cursos con conteos
            $stmt = $pdo->prepare("
                SELECT c.*, 
                       (SELECT COUNT(*) FROM lecciones WHERE curso_id = c.id AND activo = 1) as total_lecciones,
                       (SELECT COUNT(*) FROM ejercicios WHERE curso_id = c.id AND activo = 1) as total_ejercicios,
                       (SELECT COUNT(*) FROM audios WHERE curso_id = c.id AND activo = 1) as total_audios,
                       (SELECT COUNT(*) FROM libros WHERE curso_id = c.id AND activo = 1) as total_libros
                FROM cursos c 
                WHERE c.activo = 1 
                ORDER BY c.semestre, c.orden
            ");
            $stmt->execute();
            $cursos = $stmt->fetchAll();
            
            echo json_encode(['success' => true, 'cursos' => $cursos]);
        }
    } catch (PDOException $e) {
        Logger::error('Error al obtener cursos', ['error' => $e->getMessage()]);
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al obtener cursos']);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['usuario_id'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'No autenticado']);
        exit();
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $titulo = trim($data['titulo'] ?? '');
    $descripcion = trim($data['descripcion'] ?? '');
    $categoria = trim($data['categoria'] ?? '');
    $nivel = $data['nivel'] ?? 'principiante';
    $duracion = $data['duracion_horas'] ?? null;
    $imagen = $data['imagen_url'] ?? null;
    $semestre = (int)($data['semestre'] ?? 1);
    
    if (empty($titulo) || empty($descripcion) || empty($categoria)) {
        echo json_encode(['success' => false, 'message' => 'Título, descripción y categoría son obligatorios']);
        exit();
    }
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO cursos (codigo, semestre, titulo, descripcion, categoria, nivel, duracion_horas, imagen_url, orden) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, (SELECT COALESCE(MAX(orden), 0) + 1 FROM cursos))
        ");
        $codigo = 'curso-' . time();
        $stmt->execute([$codigo, $semestre, $titulo, $descripcion, $categoria, $nivel, $duracion, $imagen]);
        
        Logger::info('Curso creado', ['usuario_id' => $_SESSION['usuario_id'], 'titulo' => $titulo]);
        
        echo json_encode(['success' => true, 'message' => 'Curso creado exitosamente']);
    } catch (PDOException $e) {
        Logger::error('Error al crear curso', ['error' => $e->getMessage()]);
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al crear curso']);
    }
    exit();
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
