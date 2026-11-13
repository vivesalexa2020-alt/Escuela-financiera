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

class AdminController extends Controller {
    private UserModel $userModel;
    private CourseModel $courseModel;
    private MembershipModel $membershipModel;
    private EnrollmentModel $enrollmentModel;
    private SettingsModel $settingsModel;

    public function __construct() {
        parent::__construct();
        $this->userModel       = new UserModel();
        $this->courseModel     = new CourseModel();
        $this->membershipModel = new MembershipModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->settingsModel   = new SettingsModel();
    }

    /**
     * Panel principal de administración (solo rol admin).
     */
    public function dashboard(): void {
        // Si no hay sesión activa, redirigir al login (la vista de retícula contiene el modal)
        if (!Session::isLoggedIn()) {
            header('Location: index.php?page=reticula#login');
            exit();
        }
        $this->requireAdmin();

        $usuarios = $this->userModel->getAll();
        $cursos   = $this->courseModel->getAllForAdmin();

        $this->view('admin/index', [
            'pageTitle' => 'Panel de Administración | Educación Financiera',
            'pageCss'   => [],
            'bodyClass' => 'admin-page',
            'user'      => Session::user(),
            'stats'     => [
                'usuarios'     => count($usuarios),
                'admins'       => $this->userModel->countByRole('admin'),
                'cursos'       => count($cursos),
                'cursos_activos' => count(array_filter($cursos, fn($c) => (int)$c['activo'] === 1)),
                'membresias'   => $this->membershipModel->countActive(),
                'inscripciones' => $this->enrollmentModel->countAll(),
            ],
            'usuarios'   => $usuarios,
            'cursos'     => $cursos,
            'membresias' => $this->membershipModel->getAllWithUsers(),
            'logins'     => $this->userModel->getRecentLogins(15),
            'cambios'    => $this->userModel->getRecentProfileChanges(15),
            'config'     => $this->settingsModel->getAll(),
            'flash'      => $this->flashMessage(),
        ], 'main');
    }

    /**
     * Actualiza el rol de un usuario (solo rol admin).
     */
    public function updateRole(): void {
        $this->requireAdmin();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirectTo('admin');
        }

        $data = $this->getRequestData();

        if (!Csrf::validateToken($data['csrf_token'] ?? '')) {
            $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'usuarios']);
        }

        $id  = (int)($data['usuario_id'] ?? 0);
        $rol = (string)($data['rol'] ?? '');

        if ($id <= 0 || !in_array($rol, ['estudiante', 'admin'], true)) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        }

        // Evitar que un administrador se quite su propio rol
        if ($id === (int)Session::userId() && $rol !== 'admin') {
            $this->redirectTo('admin', ['error' => 'self', 'tab' => 'usuarios']);
        }

        $target = $this->userModel->findAnyById($id);
        if (!$target) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        }

        // Evitar dejar el sistema sin administradores
        if ($target['rol'] === 'admin' && $rol !== 'admin' && $this->userModel->countByRole('admin') <= 1) {
            $this->redirectTo('admin', ['error' => 'ultimo_admin', 'tab' => 'usuarios']);
        }

        try {
            if ($this->userModel->updateRole($id, $rol)) {
                $this->redirectTo('admin', ['ok' => 1, 'tab' => 'usuarios']);
            }
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar rol', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db', 'tab' => 'usuarios']);
        }
    }

    /**
     * Activa o desactiva una cuenta de usuario (solo rol admin).
     */
    public function updateStatus(): void {
        $this->requireAdmin();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirectTo('admin', ['tab' => 'usuarios']);
        }

        $data = $this->getRequestData();

        if (!Csrf::validateToken($data['csrf_token'] ?? '')) {
            $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'usuarios']);
        }

        $id     = (int)($data['usuario_id'] ?? 0);
        $activo = (string)($data['activo'] ?? '');

        if ($id <= 0 || !in_array($activo, ['0', '1'], true)) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        }

        $target = $this->userModel->findAnyById($id);
        if (!$target) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        }

        if ($id === (int)Session::userId() && $activo === '0') {
            $this->redirectTo('admin', ['error' => 'self', 'tab' => 'usuarios']);
        }

        if ($target['rol'] === 'admin' && $activo === '0' && $this->userModel->countByRole('admin') <= 1) {
            $this->redirectTo('admin', ['error' => 'ultimo_admin', 'tab' => 'usuarios']);
        }

        if ($this->userModel->setActive($id, $activo === '1')) {
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'usuarios']);
        }

        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'usuarios']);
    }

    /**
     * Elimina (borrado lógico) una cuenta de usuario (solo rol admin).
     */
    public function deleteUser(): void {
        $this->requireAdmin();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirectTo('admin', ['tab' => 'usuarios']);
        }

        $data = $this->getRequestData();

        if (!Csrf::validateToken($data['csrf_token'] ?? '')) {
            $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'usuarios']);
        }

        $id = (int)($data['usuario_id'] ?? 0);
        if ($id <= 0) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        }

        if ($id === (int)Session::userId()) {
            $this->redirectTo('admin', ['error' => 'self', 'tab' => 'usuarios']);
        }

        $target = $this->userModel->findAnyById($id);
        if (!$target) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'usuarios']);
        }

        if ($target['rol'] === 'admin' && $this->userModel->countByRole('admin') <= 1) {
            $this->redirectTo('admin', ['error' => 'ultimo_admin', 'tab' => 'usuarios']);
        }

        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        if ($this->userModel->softDelete($id, $ip)) {
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'usuarios']);
        }

        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'usuarios']);
    }

    /**
     * Activa o desactiva un curso (solo rol admin).
     */
    public function updateCourseStatus(): void {
        $this->requireAdmin();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirectTo('admin', ['tab' => 'cursos']);
        }

        $data = $this->getRequestData();

        if (!Csrf::validateToken($data['csrf_token'] ?? '')) {
            $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'cursos']);
        }

        $id     = (int)($data['curso_id'] ?? 0);
        $activo = (string)($data['activo'] ?? '');

        if ($id <= 0 || !in_array($activo, ['0', '1'], true)) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'cursos']);
        }

        if ($this->courseModel->setActive($id, $activo === '1')) {
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'cursos']);
        }

        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'cursos']);
    }

    /**
     * Actualiza el plan y estado de una membresía (solo rol admin).
     */
    public function updateMembership(): void {
        $this->requireAdmin();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirectTo('admin', ['tab' => 'membresias']);
        }

        $data = $this->getRequestData();

        if (!Csrf::validateToken($data['csrf_token'] ?? '')) {
            $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'membresias']);
        }

        $id     = (int)($data['membresia_id'] ?? 0);
        $tipo   = (string)($data['tipo_membresia'] ?? '');
        $activa = (string)($data['activa'] ?? '');
        $fecha  = trim((string)($data['fecha_vencimiento'] ?? ''));

        if ($id <= 0 || !in_array($tipo, ['gratis', 'pro', 'premium'], true) || !in_array($activa, ['0', '1'], true)) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'membresias']);
        }

        if ($fecha !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'membresias']);
        }

        if ($this->membershipModel->updateById($id, $tipo, $activa === '1', $fecha === '' ? null : $fecha)) {
            $this->redirectTo('admin', ['ok' => 1, 'tab' => 'membresias']);
        }

        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'membresias']);
    }

    /**
     * Guarda la configuración general de la plataforma (solo rol admin).
     */
    public function updateSettings(): void {
        $this->requireAdmin();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirectTo('admin', ['tab' => 'config']);
        }

        $data = $this->getRequestData();

        if (!Csrf::validateToken($data['csrf_token'] ?? '')) {
            $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'config']);
        }

        $nombre = trim((string)($data['nombre_plataforma'] ?? ''));
        $correo = trim((string)($data['correo_soporte'] ?? ''));
        $moneda = (string)($data['moneda'] ?? 'MXN');
        $zona   = (string)($data['zona_horaria'] ?? 'America/Mexico_City');

        $maxIntentos = filter_var($data['login_max_intentos'] ?? 5, FILTER_VALIDATE_INT);
        $ventana     = filter_var($data['login_ventana_minutos'] ?? 15, FILTER_VALIDATE_INT);

        $permitirRegistro = (string)($data['permitir_registro'] ?? '0') === '1' ? '1' : '0';
        $mantenimiento    = (string)($data['modo_mantenimiento'] ?? '0') === '1' ? '1' : '0';
        $mensaje          = trim((string)($data['mensaje_mantenimiento'] ?? ''));

        $monedas = ['MXN', 'USD', 'EUR', 'COP', 'ARS', 'CLP', 'PEN'];
        $zonas   = \DateTimeZone::listIdentifiers();

        if ($nombre === '' || mb_strlen($nombre) > 80) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']);
        }
        if ($correo !== '' && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']);
        }
        if (!in_array($moneda, $monedas, true) || !in_array($zona, $zonas, true)) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']);
        }
        if ($maxIntentos === false || $maxIntentos < 1 || $maxIntentos > 20) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']);
        }
        if ($ventana === false || $ventana < 1 || $ventana > 120) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']);
        }
        if (mb_strlen($mensaje) > 500) {
            $this->redirectTo('admin', ['error' => 'datos', 'tab' => 'config']);
        }
        if ($mensaje === '') {
            $mensaje = 'Estamos realizando mejoras en la plataforma. Vuelve en unos minutos.';
        }

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
        ]);

        $this->redirectTo('admin', $ok
            ? ['ok' => 'config', 'tab' => 'config']
            : ['error' => 'db', 'tab' => 'config']);
    }

    /**
     * Cambia la contraseña del administrador autenticado.
     */
    public function updatePassword(): void {
        $this->requireAdmin();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            $this->redirectTo('admin', ['tab' => 'config']);
        }

        $data = $this->getRequestData();

        if (!Csrf::validateToken($data['csrf_token'] ?? '')) {
            $this->redirectTo('admin', ['error' => 'csrf', 'tab' => 'config']);
        }

        $actual    = (string)($data['password_actual'] ?? '');
        $nueva     = (string)($data['password_nueva'] ?? '');
        $confirmar = (string)($data['password_confirmar'] ?? '');

        $usuario = $this->userModel->findByEmail((string)Session::get('email', ''));
        if (!$usuario || !password_verify($actual, $usuario['password_hash'])) {
            $this->redirectTo('admin', ['error' => 'password_actual', 'tab' => 'config']);
        }

        if ($nueva !== $confirmar) {
            $this->redirectTo('admin', ['error' => 'password_coincide', 'tab' => 'config']);
        }

        if (strlen($nueva) < 8
            || !preg_match('/[A-Z]/', $nueva)
            || !preg_match('/[0-9]/', $nueva)
            || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $nueva)) {
            $this->redirectTo('admin', ['error' => 'password_debil', 'tab' => 'config']);
        }

        $hash = password_hash($nueva, PASSWORD_DEFAULT);

        if ($this->userModel->updatePassword((int)Session::userId(), $hash)) {
            $this->redirectTo('admin', ['ok' => 'password', 'tab' => 'config']);
        }

        $this->redirectTo('admin', ['error' => 'db', 'tab' => 'config']);
    }

    private function flashMessage(): ?array {
        if (isset($_GET['ok'])) {
            $ok = is_string($_GET['ok']) ? $_GET['ok'] : '';
            $map = [
                'config'   => 'Configuración guardada correctamente.',
                'password' => 'Contraseña actualizada correctamente.',
            ];
            return ['tipo' => 'ok', 'texto' => $map[$ok] ?? 'Cambios guardados correctamente.'];
        }

        if (isset($_GET['error'])) {
            $map = [
                'csrf'         => 'Token de seguridad inválido. Recarga la página.',
                'self'         => 'No puedes realizar esa acción sobre tu propia cuenta.',
                'ultimo_admin' => 'No puedes dejar el sistema sin ningún administrador.',
                'datos'            => 'Datos inválidos. Revisa los campos del formulario.',
                'db'               => 'Error al guardar los cambios.',
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
