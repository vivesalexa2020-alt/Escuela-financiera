<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\SettingsModel;

class PageController extends Controller {
    public function home(): void {
        $this->renderPage('home', 'inicio/index', 'Inicio | Educación Financiera', '');
    }

    public function cursos(): void {
        $this->renderPage('cursos', 'aprendizaje/cursos', 'Cursos y Programas | Educación Financiera', 'user-logged-in');
    }

    public function aula(): void {
        $this->renderPage('aula', 'aprendizaje/detalle-curso', 'Aula Virtual | Educación Financiera', 'user-logged-in');
    }

    public function recursos(): void {
        $this->renderPage('recursos', 'herramientas/recursos', 'Recursos y Herramientas | Educación Financiera', 'user-logged-in');
    }

    public function reticula(): void {
        $this->renderPage('reticula', 'aprendizaje/reticula', 'Retícula Académica | Educación Financiera', 'user-logged-in');
    }

    public function metas(): void {
        $this->renderPage('metas', 'herramientas/metas', 'Mis Metas Financieras | Educación Financiera', 'user-logged-in');
    }

    public function configuraciones(): void {
        $this->renderPage('configuraciones', 'cuenta/configuraciones', 'Configuración de Perfil | Educación Financiera', 'user-logged-in');
    }

    public function suscripcion(): void {
        $this->renderPage('suscripcion', 'cuenta/suscripcion', 'Planes y Membresías | Educación Financiera', 'user-logged-in');
    }

    private function renderPage(string $slug, string $view, string $title, string $bodyClass): void {
        $settings = new SettingsModel();

        if ($slug !== 'reticula'
            && Session::get('rol') !== 'admin'
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

        $this->view($view, [
            'pageTitle'   => $title,
            'pageCss'     => ["public/css/pages/{$slug}.css"],
            'bodyClass'   => $bodyClass,
            'user'        => Session::user(),
            'currentPage' => $slug,
        ], 'main');
    }
}
