<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Core\Logger;
use App\Models\UserModel;
use App\Models\CourseModel;

class AdminController extends Controller {
    private UserModel $userModel;
    private CourseModel $courseModel;

    public function __construct() {
        parent::__construct();
        $this->userModel   = new UserModel();
        $this->courseModel = new CourseModel();
    }

    /**
     * Panel principal de administración (solo rol admin).
     */
    public function dashboard(): void {
        // Si no hay sesión activa, redirigir al inicio con hash #login
        if (!Session::isLoggedIn()) {
            header('Location: index.php#login');
            exit();
        }
        $this->requireAdmin();

        $this->view('admin/index', [
            'pageTitle' => 'Panel de Administración | Educación Financiera',
            'pageCss'   => [],
            'bodyClass' => 'admin-page',
            'user'      => Session::user(),
            'stats'     => [
                'usuarios' => $this->userModel->countAll(),
                'admins'   => $this->userModel->countByRole('admin'),
                'cursos'   => count($this->courseModel->getAllWithCounts()),
            ],
            'usuarios'  => $this->userModel->getAll(),
            'flash'     => $this->flashMessage(),
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
            $this->redirectTo('admin', ['error' => 'csrf']);
        }

        $id  = (int)($data['usuario_id'] ?? 0);
        $rol = (string)($data['rol'] ?? '');

        if ($id <= 0 || !in_array($rol, ['estudiante', 'admin'], true)) {
            $this->redirectTo('admin', ['error' => 'datos']);
        }

        // Evitar que un administrador se quite su propio rol
        if ($id === (int)Session::userId() && $rol !== 'admin') {
            $this->redirectTo('admin', ['error' => 'self']);
        }

        $target = $this->userModel->findById($id);
        if (!$target) {
            $this->redirectTo('admin', ['error' => 'datos']);
        }

        // Evitar dejar el sistema sin administradores
        if ($target['rol'] === 'admin' && $rol !== 'admin' && $this->userModel->countByRole('admin') <= 1) {
            $this->redirectTo('admin', ['error' => 'ultimo_admin']);
        }

        try {
            if ($this->userModel->updateRole($id, $rol)) {
                $this->redirectTo('admin', ['ok' => 1]);
            }
            $this->redirectTo('admin', ['error' => 'datos']);
        } catch (\Exception $e) {
            Logger::error('Error al actualizar rol', ['error' => $e->getMessage()]);
            $this->redirectTo('admin', ['error' => 'db']);
        }
    }

    private function flashMessage(): ?array {
        if (isset($_GET['ok'])) {
            return ['tipo' => 'ok', 'texto' => 'Rol actualizado correctamente.'];
        }

        if (isset($_GET['error'])) {
            $map = [
                'csrf'         => 'Token de seguridad inválido. Recarga la página.',
                'self'         => 'No puedes quitarte tu propio rol de administrador.',
                'ultimo_admin' => 'No puedes dejar el sistema sin ningún administrador.',
                'datos'        => 'Datos inválidos.',
                'db'           => 'Error al guardar los cambios.',
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
