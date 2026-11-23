<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Logger;
use App\Models\SettingsModel;

class PageController extends Controller {
    public function home(): void {
        $this->renderPage('home', 'inicio/index', 'Inicio | Educación Financiera', '');
    }

    public function aula(): void {
        $esDemo = isset($_GET['preview']) && (string)$_GET['preview'] === '1';

        if (!Session::userId() && !$esDemo) {
            header('Location: index.php?page=home');
            exit();
        }

        $bodyClass = $esDemo ? 'demo-preview' : 'user-logged-in';
        $title = $esDemo
            ? 'Unidad 1 Gratis | Educación Financiera'
            : 'Aula Virtual | Educación Financiera';
        $this->renderPage(
            'aula',
            'aprendizaje/detalle-curso',
            $title,
            $bodyClass,
            ['esDemo' => $esDemo]
        );
    }

    public function recursos(): void {
        if (!Session::userId()) {
            header('Location: index.php?page=home');
            exit();
        }
        $this->renderPage('recursos', 'herramientas/recursos', 'Recursos y Herramientas | Educación Financiera', 'user-logged-in');
    }

    public function reticula(): void {
        if (!Session::userId()) {
            header('Location: index.php?page=home');
            exit();
        }
        $this->renderPage('reticula', 'aprendizaje/reticula', 'Retícula Académica | Educación Financiera', 'user-logged-in');
    }

    public function metas(): void {
        if (!Session::userId()) {
            header('Location: index.php?page=home');
            exit();
        }
        $this->renderPage('metas', 'herramientas/metas', 'Mis Metas Financieras | Educación Financiera', 'user-logged-in');
    }

    public function configuraciones(): void {
        if (!Session::userId()) {
            header('Location: index.php?page=home');
            exit();
        }
        $this->renderPage('configuraciones', 'cuenta/configuraciones', 'Configuración de Perfil | Educación Financiera', 'user-logged-in');
    }

    public function suscripcion(): void {
        if (!Session::userId()) {
            header('Location: index.php?page=home');
            exit();
        }
        $this->renderPage('suscripcion', 'cuenta/suscripcion', 'Planes y Membresías | Educación Financiera', 'user-logged-in');
    }

    private function renderPage(string $slug, string $view, string $title, string $bodyClass, array $extraData = []): void {
        $settings = new SettingsModel();

        if ($slug !== 'reticula'
            && !Session::isAdmin()
            && $settings->isEnabled('modo_mantenimiento')) {
            http_response_code(503);
            $this->view('errores/mantenimiento', [
                'pageTitle'   => 'Mantenimiento | ' . $settings->get('nombre_plataforma'),
                'pageCss'     => [],
                'bodyClass'   => 'maintenance-page',
                'user'        => Session::user(),
                'currentPage' => '',
                'mensaje'     => $settings->get('mensaje_mantenimiento'),
                'nombre'      => $settings->get('nombre_plataforma'),
            ], 'main');
            return;
        }

        $userId = Session::userId();
        $tieneMembresia = false;
        if ($userId) {
            if (Session::isAdmin()) {
                $tieneMembresia = true;
            } else {
                try {
                    $membershipModel = new \App\Models\MembershipModel();
                    $mem = $membershipModel->getByUser($userId);
                    $tieneMembresia = !empty($mem['activa']) && in_array($mem['tipo_membresia'], ['pro', 'premium'], true);
                } catch (\Throwable $e) {
                    Logger::warning('Error consultando membresía en renderPage', ['error' => $e->getMessage()]);
                }
            }
        }

        $this->view($view, array_merge([
            'pageTitle'      => $title,
            'pageCss'        => ["public/css/pages/{$slug}.css"],
            'bodyClass'      => $bodyClass,
            'user'           => Session::user(),
            'currentPage'    => $slug,
            'tieneMembresia' => $tieneMembresia,
        ], $extraData), 'main');
    }
}
