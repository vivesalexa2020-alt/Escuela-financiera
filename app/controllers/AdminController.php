<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Core\Logger;
use App\Models\UserModel;
use App\Models\CourseModel;
use App\Models\MembershipModel;
use App\Models\EnrollmentModel;
use App\Models\SettingsModel;
use App\Models\ProgressModel;
use App\Models\AchievementModel;

class AdminController extends Controller {
    private UserModel $userModel;
    private CourseModel $courseModel;
    private MembershipModel $membershipModel;
    private EnrollmentModel $enrollmentModel;
    private SettingsModel $settingsModel;
    private ProgressModel $progressModel;
    private AchievementModel $achievementModel;

    public function __construct() {
        parent::__construct();
        $this->userModel       = new UserModel();
        $this->courseModel     = new CourseModel();
        $this->membershipModel = new MembershipModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->settingsModel   = new SettingsModel();
        $this->progressModel   = new ProgressModel();
        $this->achievementModel = new AchievementModel();
    }

    public function dashboard(): void {
        if (!Session::isLoggedIn()) {
            header('Location: index.php?page=reticula#login');
            exit();
        }
        $this->requireAdmin();

        $usuarios      = $this->userModel->getAll();
        $cursos        = $this->courseModel->getAllForAdmin();
        $inscripciones = $this->enrollmentModel->getAllForAdmin();
        $progresos     = $this->progressModel->getAllForAdmin();
        $logros        = $this->achievementModel->getAllForAdmin();

        // Curso seleccionado para la pestaña de gestión de contenidos (videos, libros, audios, ejercicios)
        $selectedCursoId = (int)($_GET['curso_id'] ?? ($cursos[0]['id'] ?? 0));
        $selectedCurso   = null;
        $leccionesCurso  = [];
        $librosCurso     = [];
        $audiosCurso     = [];
        $ejerciciosCurso = [];

        if ($selectedCursoId > 0) {
            $selectedCurso = $this->courseModel->findByIdAdmin($selectedCursoId);
            if ($selectedCurso) {
                $leccionesCurso  = $this->courseModel->getAllLessons($selectedCursoId);
                $librosCurso     = $this->courseModel->getAllBooks($selectedCursoId);
                $audiosCurso     = $this->courseModel->getAllAudios($selectedCursoId);
                $ejerciciosCurso = $this->courseModel->getAllExercises($selectedCursoId);
            }
        }

        $this->view('admin/index', [
            'pageTitle' => 'Panel de Administración | Educación Financiera',
            'pageCss'   => [],
            'bodyClass' => 'admin-page',
            'user'      => Session::user(),
            'stats'     => [
                'usuarios'       => count($usuarios),
                'admins'         => $this->userModel->countByRole('admin'),
                'cursos'         => count($cursos),
                'cursos_activos' => count(array_filter($cursos, fn($c) => (int)$c['activo'] === 1)),
                'membresias'     => $this->membershipModel->countActive(),
                'inscripciones'  => count($inscripciones),
                'progresos'      => count($progresos),
                'logros'         => count($logros),
            ],
            'usuarios'        => $usuarios,
            'cursos'          => $cursos,
            'selectedCursoId' => $selectedCursoId,
            'selectedCurso'   => $selectedCurso,
            'leccionesCurso'  => $leccionesCurso,
            'librosCurso'     => $librosCurso,
            'audiosCurso'     => $audiosCurso,
            'ejerciciosCurso' => $ejerciciosCurso,
            'membresias'      => $this->membershipModel->getAllWithUsers(),
            'inscripciones'   => $inscripciones,
            'progresos'       => $progresos,
            'logros'          => $logros,
            'logins'          => $this->userModel->getRecentLogins(15),
            'cambios'         => $this->userModel->getRecentProfileChanges(15),
            'config'          => $this->settingsModel->getAll(),
            'flash'           => $this->flashMessage(),
        ], 'main');
    }

    // ── GESTIÓN DE USUARIOS ──────────────────────────────────────────

    public function updateRole(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin'); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'usuarios']); }
        $id  = (int)($data['usuario_id'] ?? 0);
        $rol = (string)($data['rol'] ?? '');
        if ($id <= 0 || !in_array($rol, ['estudiante', 'admin'], true)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']); }
        if ($id === (int)Session::userId() && $rol !== 'admin') { $this->redirectTo('admin', ['error' => 'self', 'tab' => 'usuarios']); }
        $target = $this->userModel->findAnyById($id);
        if (!$target) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']); }
        if ($target['rol'] === 'admin' && $rol !== 'admin' && $this->userModel->countByRole('admin') <= 1) { $this->redirectTo('admin', ['error' => 'ultimo_admin', 'tab' => 'usuarios']); }
        try {
            if ($this->userModel->updateRole($id, $rol)) { $this->redirectTo('admin', ['ok' => 1, 'tab' => 'usuarios']); }
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar rol', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'usuarios']);
        }
    }

    public function updateStatus(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'usuarios']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'usuarios']); }
        $id = (int)($data['usuario_id'] ?? 0);
        $activo = (string)($data['activo'] ?? '');
        if ($id <= 0 || !in_array($activo, ['0', '1'], true)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']); }
        $target = $this->userModel->findAnyById($id);
        if (!$target) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']); }
        if ($id === (int)Session::userId() && $activo === '0') { $this->redirectTo('admin', ['error' => 'self', 'tab' => 'usuarios']); }
        if ($target['rol'] === 'admin' && $activo === '0' && $this->userModel->countByRole('admin') <= 1) { $this->redirectTo('admin', ['error' => 'ultimo_admin', 'tab' => 'usuarios']); }
        if ($this->userModel->setActive($id, $activo === '1')) { $this->redirectTo('admin', ['ok' => 1, 'tab' => 'usuarios']); }
        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'usuarios']);
    }

    public function deleteUser(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'usuarios']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'usuarios']); }
        $id = (int)($data['usuario_id'] ?? 0);
        if ($id <= 0) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']); }
        if ($id === (int)Session::userId()) { $this->redirectTo('admin', ['error' => 'self', 'tab' => 'usuarios']); }
        $target = $this->userModel->findAnyById($id);
        if (!$target) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']); }
        if ($target['rol'] === 'admin' && $this->userModel->countByRole('admin') <= 1) { $this->redirectTo('admin', ['error' => 'ultimo_admin', 'tab' => 'usuarios']); }
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        if ($this->userModel->softDelete($id, $ip)) { $this->redirectTo('admin', ['ok' => 1, 'tab' => 'usuarios']); }
        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'usuarios']);
    }

    // ── GESTIÓN DE CURSOS ────────────────────────────────────────────

    public function createCourse(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'cursos']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'cursos']); }

        $codigo = trim((string)($data['codigo'] ?? ''));
        $semestre = (int)($data['semestre'] ?? 1);
        $titulo = trim((string)($data['titulo'] ?? ''));
        $descripcion = trim((string)($data['descripcion'] ?? ''));
        $categoria = trim((string)($data['categoria'] ?? ''));
        $nivel = (string)($data['nivel'] ?? 'principiante');
        $duracion = ($data['duracion_horas'] ?? '') !== '' ? (float)$data['duracion_horas'] : null;
        $orden = (int)($data['orden'] ?? 0);
        $activo = (string)($data['activo'] ?? '1') === '1' ? 1 : 0;

        // Subida de imagen opcional
        $uploaded = $this->handleFileUpload('imagen_archivo', 'cursos', ['jpg','jpeg','png','webp','gif']);
        $imagenUrl = $uploaded ?: trim((string)($data['imagen_url'] ?? '')) ?: null;

        if ($codigo === '' || $titulo === '' || $descripcion === '' || $categoria === '') {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']);
        }
        if (!in_array($nivel, ['principiante','intermedio','avanzado'], true) || $semestre < 1 || $semestre > 10) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']);
        }

        try {
            $newId = $this->courseModel->createCourse([
                'codigo'         => $codigo,
                'semestre'       => $semestre,
                'titulo'         => $titulo,
                'descripcion'    => $descripcion,
                'categoria'      => $categoria,
                'nivel'          => $nivel,
                'duracion_horas' => $duracion,
                'imagen_url'     => $imagenUrl,
                'orden'          => $orden,
                'activo'         => $activo,
            ]);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'cursos', 'curso_id' => $newId]);
        } catch (\Exception $e) {
            Logger::error('Error al crear curso', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'cursos']);
        }
    }

    public function updateCourse(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'cursos']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'cursos']); }
        $id = (int)($data['curso_id'] ?? 0);
        $curso = $id > 0 ? $this->courseModel->findByIdAdmin($id) : null;
        if (!$curso) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']); }

        $uploaded = $this->handleFileUpload('imagen_archivo', 'cursos', ['jpg','jpeg','png','webp','gif']);
        $imagenUrl = $uploaded ?: (trim((string)($data['imagen_url'] ?? '')) ?: $curso['imagen_url']);

        $payload = [
            'codigo'         => trim((string)($data['codigo'] ?? $curso['codigo'])),
            'semestre'       => (int)($data['semestre'] ?? $curso['semestre']),
            'titulo'         => trim((string)($data['titulo'] ?? $curso['titulo'])),
            'descripcion'    => trim((string)($data['descripcion'] ?? $curso['descripcion'])),
            'categoria'      => trim((string)($data['categoria'] ?? $curso['categoria'])),
            'nivel'          => (string)($data['nivel'] ?? $curso['nivel']),
            'duracion_horas' => ($data['duracion_horas'] ?? '') !== '' ? (float)$data['duracion_horas'] : null,
            'imagen_url'     => $imagenUrl,
            'orden'          => (int)($data['orden'] ?? $curso['orden']),
            'activo'         => (string)($data['activo'] ?? $curso['activo']) === '1' ? 1 : 0,
        ];
        if ($payload['codigo'] === '' || $payload['titulo'] === '' || $payload['descripcion'] === '' || $payload['categoria'] === '') {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']);
        }
        if (!in_array($payload['nivel'], ['principiante','intermedio','avanzado'], true) || $payload['semestre'] < 1 || $payload['semestre'] > 10) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']);
        }
        try {
            $this->courseModel->updateBasic($id, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'cursos']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar curso', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'cursos']);
        }
    }

    public function updateCourseStatus(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'cursos']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'cursos']); }
        $id = (int)($data['curso_id'] ?? 0);
        $activo = (string)($data['activo'] ?? '');
        if ($id <= 0 || !in_array($activo, ['0', '1'], true)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']); }
        if ($this->courseModel->setActive($id, $activo === '1')) { $this->redirectTo('admin', ['ok' => 1, 'tab' => 'cursos']); }
        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'cursos']);
    }

    public function deleteCourse(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'cursos']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'cursos']); }
        $id = (int)($data['curso_id'] ?? 0);
        if ($id <= 0) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']); }
        try {
            $this->courseModel->deleteCourse($id);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'cursos']);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar curso', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'cursos']);
        }
    }

    // ── GESTIÓN DE LECCIONES / VIDEOS ────────────────────────────────

    public function createLesson(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        if ($cursoId <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $payload = [
            'titulo'    => $titulo,
            'contenido' => trim((string)($data['contenido'] ?? '')),
            'video_url' => trim((string)($data['video_url'] ?? '')) ?: null,
            'duracion'  => trim((string)($data['duracion'] ?? '15:00')) ?: '15:00',
            'orden'     => (int)($data['orden'] ?? 0),
            'activo'    => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->createLesson($cursoId, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'videos']);
        } catch (\Exception $e) {
            Logger::error('Error al crear lección', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function updateLesson(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['leccion_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        if ($id <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $payload = [
            'titulo'    => $titulo,
            'contenido' => trim((string)($data['contenido'] ?? '')),
            'video_url' => trim((string)($data['video_url'] ?? '')) ?: null,
            'duracion'  => trim((string)($data['duracion'] ?? '15:00')) ?: '15:00',
            'orden'     => (int)($data['orden'] ?? 0),
            'activo'    => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->updateLesson($id, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'videos']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar lección', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function deleteLesson(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['leccion_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        if ($id <= 0) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }
        try {
            $this->courseModel->deleteLesson($id);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'videos']);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar lección', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    // ── GESTIÓN DE LIBROS / EBOOKS ───────────────────────────────────

    public function createBook(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        $autor   = trim((string)($data['autor'] ?? ''));
        if ($cursoId <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $uploaded = $this->handleFileUpload('archivo_file', 'libros', ['pdf','epub','mobi','doc','docx']);
        $archivoUrl = $uploaded ?: (trim((string)($data['archivo_url'] ?? '')) ?: null);

        $payload = [
            'titulo'      => $titulo,
            'autor'       => $autor ?: 'Educación Financiera',
            'descripcion' => trim((string)($data['descripcion'] ?? '')),
            'tipo'        => trim((string)($data['tipo'] ?? 'ebook')) ?: 'ebook',
            'archivo_url' => $archivoUrl,
            'orden'       => (int)($data['orden'] ?? 0),
            'activo'      => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->createBook($cursoId, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'libros']);
        } catch (\Exception $e) {
            Logger::error('Error al crear libro', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function updateBook(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['libro_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        if ($id <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $uploaded = $this->handleFileUpload('archivo_file', 'libros', ['pdf','epub','mobi','doc','docx']);
        $existing = $this->courseModel->findBookById($id);
        $archivoUrl = $uploaded ?: (trim((string)($data['archivo_url'] ?? '')) ?: ($existing['archivo_url'] ?? null));

        $payload = [
            'titulo'      => $titulo,
            'autor'       => trim((string)($data['autor'] ?? '')) ?: 'Educación Financiera',
            'descripcion' => trim((string)($data['descripcion'] ?? '')),
            'tipo'        => trim((string)($data['tipo'] ?? 'ebook')) ?: 'ebook',
            'archivo_url' => $archivoUrl,
            'orden'       => (int)($data['orden'] ?? 0),
            'activo'      => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->updateBook($id, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'libros']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar libro', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function deleteBook(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['libro_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        if ($id <= 0) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }
        try {
            $this->courseModel->deleteBook($id);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'libros']);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar libro', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    // ── GESTIÓN DE AUDIOS / PODCASTS ─────────────────────────────────

    public function createAudio(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        if ($cursoId <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $uploaded = $this->handleFileUpload('audio_file', 'audios', ['mp3','wav','ogg','m4a','aac']);
        $audioUrl = $uploaded ?: (trim((string)($data['audio_url'] ?? '')) ?: null);

        $payload = [
            'titulo'      => $titulo,
            'descripcion' => trim((string)($data['descripcion'] ?? '')),
            'duracion'    => trim((string)($data['duracion'] ?? '20:00')) ?: '20:00',
            'audio_url'   => $audioUrl,
            'orden'       => (int)($data['orden'] ?? 0),
            'activo'      => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->createAudio($cursoId, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'audios']);
        } catch (\Exception $e) {
            Logger::error('Error al crear audio', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function updateAudio(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['audio_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        if ($id <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $uploaded = $this->handleFileUpload('audio_file', 'audios', ['mp3','wav','ogg','m4a','aac']);
        $existing = $this->courseModel->findAudioById($id);
        $audioUrl = $uploaded ?: (trim((string)($data['audio_url'] ?? '')) ?: ($existing['audio_url'] ?? null));

        $payload = [
            'titulo'      => $titulo,
            'descripcion' => trim((string)($data['descripcion'] ?? '')),
            'duracion'    => trim((string)($data['duracion'] ?? '20:00')) ?: '20:00',
            'audio_url'   => $audioUrl,
            'orden'       => (int)($data['orden'] ?? 0),
            'activo'      => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->updateAudio($id, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'audios']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar audio', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function deleteAudio(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['audio_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        if ($id <= 0) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }
        try {
            $this->courseModel->deleteAudio($id);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'audios']);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar audio', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    // ── GESTIÓN DE EJERCICIOS / PRÁCTICAS ────────────────────────────

    public function createExercise(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        if ($cursoId <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $payload = [
            'titulo'      => $titulo,
            'tipo'        => trim((string)($data['tipo'] ?? 'practica')) ?: 'practica',
            'descripcion' => trim((string)($data['descripcion'] ?? '')),
            'orden'       => (int)($data['orden'] ?? 0),
            'activo'      => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->createExercise($cursoId, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'ejercicios']);
        } catch (\Exception $e) {
            Logger::error('Error al crear ejercicio', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function updateExercise(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['ejercicio_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        $titulo  = trim((string)($data['titulo'] ?? ''));
        if ($id <= 0 || $titulo === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }

        $payload = [
            'titulo'      => $titulo,
            'tipo'        => trim((string)($data['tipo'] ?? 'practica')) ?: 'practica',
            'descripcion' => trim((string)($data['descripcion'] ?? '')),
            'orden'       => (int)($data['orden'] ?? 0),
            'activo'      => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->courseModel->updateExercise($id, $payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'ejercicios']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar ejercicio', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    public function deleteExercise(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'contenido']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'contenido']); }
        $id      = (int)($data['ejercicio_id'] ?? 0);
        $cursoId = (int)($data['curso_id'] ?? 0);
        if ($id <= 0) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'contenido', 'curso_id' => $cursoId]); }
        try {
            $this->courseModel->deleteExercise($id);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'contenido', 'curso_id' => $cursoId, 'sec' => 'ejercicios']);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar ejercicio', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'contenido', 'curso_id' => $cursoId]);
        }
    }

    // ── GESTIÓN DE MEMBRESÍAS ────────────────────────────────────────

    public function updateMembership(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'membresias']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'membresias']); }
        $id = (int)($data['membresia_id'] ?? 0);
        $tipo = (string)($data['tipo_membresia'] ?? '');
        $activa = (string)($data['activa'] ?? '');
        $fecha = trim((string)($data['fecha_vencimiento'] ?? ''));
        if ($id <= 0 || !in_array($tipo, ['gratis', 'pro', 'premium'], true) || !in_array($activa, ['0', '1'], true)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'membresias']); }
        if ($fecha !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'membresias']); }
        if ($this->membershipModel->updateById($id, $tipo, $activa === '1', $fecha === '' ? null : $fecha)) { $this->redirectTo('admin', ['ok' => 1, 'tab' => 'membresias']); }
        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'membresias']);
    }

    // ── GESTIÓN DE LOGROS ────────────────────────────────────────────

    public function createLogro(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'logros']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'logros']); }
        $nombre = trim((string)($data['nombre'] ?? ''));
        if ($nombre === '') { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'logros']); }

        $payload = [
            'nombre'            => $nombre,
            'descripcion'       => trim((string)($data['descripcion'] ?? '')),
            'icono'             => trim((string)($data['icono'] ?? '🏅')) ?: '🏅',
            'puntos_requeridos' => (int)($data['puntos_requeridos'] ?? 0),
            'cursos_requeridos' => ($data['cursos_requeridos'] ?? '') !== '' ? (int)$data['cursos_requeridos'] : null,
            'activo'            => (string)($data['activo'] ?? '1') === '1' ? 1 : 0,
        ];
        try {
            $this->achievementModel->createLogro($payload);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'logros']);
        } catch (\Exception $e) {
            Logger::error('Error al crear logro', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'logros']);
        }
    }

    public function updateLogroStatus(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'logros']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'logros']); }
        $id = (int)($data['logro_id'] ?? 0);
        $activo = (string)($data['activo'] ?? '');
        if ($id <= 0 || !in_array($activo, ['0', '1'], true)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'logros']); }
        if ($this->achievementModel->setActive($id, $activo === '1')) { $this->redirectTo('admin', ['ok' => 1, 'tab' => 'logros']); }
        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'logros']);
    }

    public function deleteLogro(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'logros']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'logros']); }
        $id = (int)($data['logro_id'] ?? 0);
        if ($id <= 0) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'logros']); }
        try {
            $this->achievementModel->deleteLogro($id);
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'logros']);
        } catch (\Exception $e) {
            Logger::error('Error al eliminar logro', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'logros']);
        }
    }

    // ── CONFIGURACIÓN Y ANUNCIOS ─────────────────────────────────────

    public function updateSettings(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'config']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'config']); }
        $nombre = trim((string)($data['nombre_plataforma'] ?? ''));
        $correo = trim((string)($data['correo_soporte'] ?? ''));
        $moneda = (string)($data['moneda'] ?? 'MXN');
        $zona   = (string)($data['zona_horaria'] ?? 'America/Mexico_City');
        $maxIntentos = filter_var($data['login_max_intentos'] ?? 5, FILTER_VALIDATE_INT);
        $ventana     = filter_var($data['login_ventana_minutos'] ?? 15, FILTER_VALIDATE_INT);
        $permitirRegistro = (string)($data['permitir_registro'] ?? '0') === '1' ? '1' : '0';
        $mantenimiento    = (string)($data['modo_mantenimiento'] ?? '0') === '1' ? '1' : '0';
        $mensaje          = trim((string)($data['mensaje_mantenimiento'] ?? ''));

        // Anuncio global para alumnos
        $anuncioActivo = (string)($data['anuncio_activo'] ?? '0') === '1' ? '1' : '0';
        $anuncioTexto  = trim((string)($data['anuncio_texto'] ?? ''));
        $anuncioTipo   = (string)($data['anuncio_tipo'] ?? 'info');
        if (!in_array($anuncioTipo, ['info', 'exito', 'alerta'], true)) {
            $anuncioTipo = 'info';
        }

        $monedas = ['MXN', 'USD', 'EUR', 'COP', 'ARS', 'CLP', 'PEN'];
        $zonas   = \DateTimeZone::listIdentifiers();
        if ($nombre === '' || mb_strlen($nombre) > 80) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']); }
        if ($correo !== '' && !filter_var($correo, FILTER_VALIDATE_EMAIL)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']); }
        if (!in_array($moneda, $monedas, true) || !in_array($zona, $zonas, true)) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']); }
        if ($maxIntentos === false || $maxIntentos < 1 || $maxIntentos > 20) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']); }
        if ($ventana === false || $ventana < 1 || $ventana > 120) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']); }
        if (mb_strlen($mensaje) > 500) { $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']); }
        if ($mensaje === '') { $mensaje = 'Estamos realizando mejoras en la plataforma. Vuelve en unos minutos.'; }

        $ok = $this->settingsModel->setMany([
            'nombre_plataforma'     => $nombre,
            'correo_soporte'        => $correo,
            'moneda'                => $moneda,
            'zona_horaria'          => $zona,
            'permitir_registro'     => $permitirRegistro,
            'login_max_intentos'    => (string)$maxIntentos,
            'login_ventana_minutos' => (string)$ventana,
            'modo_mantenimiento'    => $mantenimiento,
            'mensaje_mantenimiento' => $mensaje,
            'anuncio_activo'        => $anuncioActivo,
            'anuncio_texto'         => $anuncioTexto,
            'anuncio_tipo'          => $anuncioTipo,
        ]);
        $this->redirectTo('admin', $ok ? ['ok' => 'config', 'tab' => 'config'] : ['error' => 'db', 'tab' => 'config']);
    }

    public function updatePassword(): void {
        $this->requireAdmin();
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { $this->redirectTo('admin', ['tab' => 'config']); }
        $data = $this->getRequestData();
        if (!Csrf::validateToken($data['csrf_token'] ?? '')) { $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'config']); }
        $actual    = (string)($data['password_actual'] ?? '');
        $nueva     = (string)($data['password_nueva'] ?? '');
        $confirmar = (string)($data['password_confirmar'] ?? '');
        $usuario = $this->userModel->findByEmail((string)Session::get('email', ''));
        if (!$usuario || !password_verify($actual, $usuario['password_hash'])) { $this->redirectTo('admin', ['error' => 'password_actual', 'tab' => 'config']); }
        if ($nueva !== $confirmar) { $this->redirectTo('admin', ['error' => 'password_coincide', 'tab' => 'config']); }
        if (strlen($nueva) < 8 || !preg_match('/[A-Z]/', $nueva) || !preg_match('/[0-9]/', $nueva) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $nueva)) {
            $this->redirectTo('admin', ['error' => 'password_debil', 'tab' => 'config']);
        }
        $hash = password_hash($nueva, PASSWORD_DEFAULT);
        if ($this->userModel->updatePassword((int)Session::userId(), $hash)) { $this->redirectTo('admin', ['ok' => 'password', 'tab' => 'config']); }
        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'config']);
    }

    // ── EXPORTACIÓN PDF OFICIAL ──────────────────────────────────────

    public function exportPdf(): void {
        $this->requireAdmin();
        $tipo = (string)($_GET['tipo'] ?? 'usuarios');
        $validos = [
            'usuarios'      => 'Directorio Oficial de Usuarios y Alumnos',
            'inscripciones' => 'Historial de Inscripciones Académicas',
            'progreso'      => 'Reporte de Avance y Progreso de Estudiantes'
        ];
        $titulo = $validos[$tipo] ?? 'Reporte Académico Oficial';
        $fecha = date('d/m/Y H:i');

        $headers = [];
        $rows = [];

        if ($tipo === 'usuarios') {
            $headers = ['ID', 'Nombre Completo', 'Correo Electrónico', 'Rol', 'Estado', 'Fecha Registro'];
            $usuarios = $this->userModel->getAll();
            foreach ($usuarios as $u) {
                $rows[] = [
                    '#' . $u['id'],
                    $u['nombre'],
                    $u['email'],
                    $u['rol'] === 'admin' ? 'Administrador' : 'Estudiante',
                    !empty($u['activo']) ? 'Activo' : 'Inactivo',
                    date('d/m/Y H:i', strtotime($u['fecha_creacion'] ?? 'now'))
                ];
            }
        } elseif ($tipo === 'inscripciones') {
            $headers = ['ID', 'Estudiante', 'Email', 'Materia ID', 'Semestre', 'Fecha Inscripción'];
            $inscripciones = $this->enrollmentModel->getAllForAdmin();
            foreach ($inscripciones as $i) {
                $rows[] = [
                    '#' . $i['id'],
                    $i['usuario_nombre'],
                    $i['usuario_email'],
                    $i['materia_id'],
                    'Semestre ' . $i['semestre'],
                    date('d/m/Y H:i', strtotime($i['fecha_inscripcion']))
                ];
            }
        } elseif ($tipo === 'progreso') {
            $headers = ['Estudiante', 'Email', 'Curso', 'Código', 'Avance', 'Estado', 'Última Actividad'];
            $progresos = $this->progressModel->getAllForAdmin();
            foreach ($progresos as $p) {
                $pct = (float)$p['porcentaje'];
                $rows[] = [
                    $p['usuario_nombre'],
                    $p['usuario_email'],
                    $p['curso_titulo'],
                    $p['curso_codigo'],
                    number_format($pct, 0) . '%',
                    ($pct >= 100 || !empty($p['completado'])) ? 'Completado' : 'En curso',
                    !empty($p['fecha_actualizacion']) ? date('d/m/Y H:i', strtotime($p['fecha_actualizacion'])) : '-'
                ];
            }
        }

        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>' . htmlspecialchars($titulo) . ' - Educación Financiera</title>';
        echo '<style>
            @page { size: letter; margin: 15mm; }
            body { font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: #0f172a; margin: 0; padding: 24px; font-size: 12px; }
            .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #00703c; padding-bottom: 12px; margin-bottom: 20px; }
            .brand h1 { margin: 0; font-size: 19px; color: #00703c; font-weight: 800; }
            .brand p { margin: 2px 0 0; font-size: 11px; color: #64748b; }
            .meta { text-align: right; font-size: 11px; color: #475569; }
            .title-section { margin-bottom: 16px; }
            .title-section h2 { margin: 0; font-size: 16px; color: #0f172a; font-weight: 700; }
            .title-section p { margin: 3px 0 0; font-size: 11px; color: #64748b; }
            table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 11px; }
            th, td { border: 1px solid #cbd5e1; padding: 8px 10px; text-align: left; }
            th { background-color: #f1f5f9; color: #1e293b; font-weight: 700; text-transform: uppercase; font-size: 10px; }
            tr:nth-child(even) { background-color: #f8fafc; }
            .footer { margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 10px; font-size: 10px; color: #94a3b8; display: flex; justify-content: space-between; }
            .no-print { margin-bottom: 20px; padding: 12px 18px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; }
            .btn-pdf { background: #00703c; color: white; border: none; padding: 9px 18px; border-radius: 6px; font-weight: 700; cursor: pointer; text-decoration: none; font-size: 12px; }
            @media print { .no-print { display: none !important; } body { padding: 0; } }
        </style></head><body>';

        echo '<div class="no-print">
            <div>
                <strong>📄 Documento Oficial Listo para Guardar:</strong> Haz clic en el botón o presiona <em>Ctrl + P</em> para guardar en formato <strong>PDF</strong>.
            </div>
            <div>
                <button class="btn-pdf" onclick="window.print()">📥 Guardar como PDF / Imprimir</button>
            </div>
        </div>';

        echo '<div class="header">
            <div class="brand">
                <h1>Educación Financiera</h1>
                <p>Plataforma Académica Oficial · Reporte del Sistema</p>
            </div>
            <div class="meta">
                <div><strong>Fecha de emisión:</strong> ' . $fecha . '</div>
                <div><strong>Total de registros:</strong> ' . count($rows) . '</div>
            </div>
        </div>';

        echo '<div class="title-section">
            <h2>' . htmlspecialchars($titulo) . '</h2>
            <p>Reporte oficial generado desde el panel de administración.</p>
        </div>';

        echo '<table><thead><tr>';
        foreach ($headers as $h) {
            echo '<th>' . htmlspecialchars($h) . '</th>';
        }
        echo '</tr></thead><tbody>';

        if (empty($rows)) {
            echo '<tr><td colspan="' . count($headers) . '" style="text-align:center;padding:24px;color:#94a3b8">No hay registros para mostrar.</td></tr>';
        } else {
            foreach ($rows as $r) {
                echo '<tr>';
                foreach ($r as $val) {
                    echo '<td>' . htmlspecialchars($val) . '</td>';
                }
                echo '</tr>';
            }
        }
        echo '</tbody></table>';

        echo '<div class="footer">
            <span>Educación Financiera © ' . date('Y') . ' · Todos los derechos reservados</span>
            <span>Generado por: ' . htmlspecialchars(Session::get('nombre', 'Administrador')) . '</span>
        </div>';

        echo '<script>
            window.addEventListener("load", function() {
                setTimeout(function() { window.print(); }, 400);
            });
        </script></body></html>';
        exit();
    }

    // ── EXPORTACIÓN CSV PARA EXCEL ───────────────────────────────────

    public function exportCsv(): void {
        $this->requireAdmin();
        $tipo = (string)($_GET['tipo'] ?? 'usuarios');
        $filename = 'reporte_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $tipo) . '_' . date('Y-m-d_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        // UTF-8 BOM para que Excel abra acentos y caracteres especiales sin problema
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        if ($tipo === 'usuarios') {
            fputcsv($output, ['ID', 'Nombre', 'Email', 'Rol', 'Estado', 'Email Verificado', 'Fecha Creación']);
            $usuarios = $this->userModel->getAll();
            foreach ($usuarios as $u) {
                fputcsv($output, [
                    $u['id'],
                    $u['nombre'],
                    $u['email'],
                    $u['rol'],
                    !empty($u['activo']) ? 'Activo' : 'Inactivo',
                    !empty($u['email_verificado']) ? 'Sí' : 'No',
                    $u['fecha_creacion'] ?? ''
                ]);
            }
        } elseif ($tipo === 'inscripciones') {
            fputcsv($output, ['ID', 'Estudiante', 'Email', 'Materia ID', 'Semestre', 'Fecha Inscripción']);
            $inscripciones = $this->enrollmentModel->getAllForAdmin();
            foreach ($inscripciones as $i) {
                fputcsv($output, [
                    $i['id'],
                    $i['usuario_nombre'],
                    $i['usuario_email'],
                    $i['materia_id'],
                    $i['semestre'],
                    $i['fecha_inscripcion']
                ]);
            }
        } elseif ($tipo === 'progreso') {
            fputcsv($output, ['ID', 'Estudiante', 'Email', 'Curso', 'Código', 'Porcentaje', 'Estado', 'Fecha Actualización']);
            $progresos = $this->progressModel->getAllForAdmin();
            foreach ($progresos as $p) {
                fputcsv($output, [
                    $p['id'],
                    $p['usuario_nombre'],
                    $p['usuario_email'],
                    $p['curso_titulo'],
                    $p['curso_codigo'],
                    $p['porcentaje'] . '%',
                    ((float)$p['porcentaje'] >= 100 || !empty($p['completado'])) ? 'Completado' : 'En curso',
                    $p['fecha_actualizacion'] ?? ''
                ]);
            }
        }
        fclose($output);
        exit();
    }

    // ── MÉTODOS PRIVADOS AUXILIARES ──────────────────────────────────

    private function handleFileUpload(string $fileKey, string $targetSubdir, array $allowedExtensions): ?string {
        if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        $file = $_FILES[$fileKey];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions, true)) {
            return null;
        }
        $targetDir = dirname(__DIR__, 2) . '/public/uploads/' . trim($targetSubdir, '/') . '/';
        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0755, true);
        }
        $cleanBase = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME));
        $filename = time() . '_' . substr($cleanBase, 0, 30) . '.' . $ext;
        $destination = $targetDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return 'public/uploads/' . trim($targetSubdir, '/') . '/' . $filename;
        }
        return null;
    }

    private function flashMessage(): ?array {
        if (isset($_GET['ok'])) {
            $ok = is_string($_GET['ok']) ? $_GET['ok'] : '';
            $map = [
                'config'   => 'Configuración guardada correctamente.',
                'password' => 'Contraseña actualizada correctamente.',
            ];
            return ['tipo' => 'ok', 'texto' => $map[$ok] ?? 'Operación realizada correctamente.'];
        }
        if (isset($_GET['error'])) {
            $map = [
                'csrf'             => 'Token de seguridad inválido. Recarga la página.',
                'self'             => 'No puedes realizar esa acción sobre tu propia cuenta.',
                'ultimo_admin'     => 'No puedes dejar el sistema sin ningún administrador.',
                'datos'            => 'Datos inválidos. Revisa los campos del formulario.',
                'db'               => 'Error al procesar la solicitud en la base de datos.',
                'password_actual'  => 'La contraseña actual no es correcta.',
                'password_coincide'=> 'La nueva contraseña y su confirmación no coinciden.',
                'password_debil'   => 'La nueva contraseña debe tener al menos 8 caracteres e incluir mayúscula, número y carácter especial.',
            ];
            $key = is_string($_GET['error']) ? $_GET['error'] : 'datos';
            return ['tipo' => 'error', 'texto' => $map[$key] ?? 'Ocurrió un error.'];
        }
        return null;
    }

    private function redirectTo(string $page, array $query = []): void {
        $script = $_SERVER['SCRIPT_NAME'] ?? 'index.php';
        $params = array_merge(['page' => $page], $query);
        header('Location: ' . $script . '?' . http_build_query($params));
        exit();
    }
}
