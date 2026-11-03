<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

class PageController extends Controller {
    public function home(): void {
        $this->renderPage('home', 'pages/home', 'Inicio | Educación Financiera', '');
    }

    public function cursos(): void {
        $this->renderPage('cursos', 'pages/cursos', 'Cursos y Programas | Educación Financiera', 'user-logged-in');
    }

    public function aula(): void {
        $this->renderPage('aula', 'pages/aula', 'Aula Virtual | Educación Financiera', 'user-logged-in');
    }

    public function recursos(): void {
        $this->renderPage('recursos', 'pages/recursos', 'Recursos y Herramientas | Educación Financiera', 'user-logged-in');
    }

    public function reticula(): void {
        $this->renderPage('reticula', 'pages/reticula', 'Retícula Académica | Educación Financiera', 'user-logged-in');
    }

    public function metas(): void {
        $this->renderPage('metas', 'pages/metas', 'Mis Metas Financieras | Educación Financiera', 'user-logged-in');
    }

    public function configuraciones(): void {
        $this->renderPage('configuraciones', 'pages/configuraciones', 'Configuración de Perfil | Educación Financiera', 'user-logged-in');
    }

    public function suscripcion(): void {
        $this->renderPage('suscripcion', 'pages/suscripcion', 'Planes y Membresías | Educación Financiera', 'user-logged-in');
    }

    private function renderPage(string $slug, string $view, string $title, string $bodyClass): void {
        $this->view($view, [
            'pageTitle' => $title,
            'pageCss'   => ["css/pages/{$slug}.css"],
            'bodyClass' => $bodyClass,
            'user'      => Session::user(),
        ], 'main');
    }
}
