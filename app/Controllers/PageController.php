<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\CourseModel;

class PageController extends Controller {
    public function home(): void {
        $courseModel = new CourseModel();
        $cursos = [];
        try {
            $cursos = $courseModel->getAllWithCounts();
        } catch (\Exception $e) {
            // Si la BD aún no está importada, se maneja graciosamente
        }

        $this->view('pages/home', [
            'pageTitle' => 'Educación Financiera | Resultados Reales, Cero Humo',
            'user'      => Session::user(),
            'cursos'    => $cursos,
        ], 'main');
    }

    public function cursos(): void {
        $courseModel = new CourseModel();
        $cursos = [];
        try {
            $cursos = $courseModel->getAllWithCounts();
        } catch (\Exception $e) {}

        $this->view('pages/cursos', [
            'pageTitle' => 'Cursos y Programas | Educación Financiera',
            'user'      => Session::user(),
            'cursos'    => $cursos,
        ], 'main');
    }

    public function aula(): void {
        $this->view('pages/aula', [
            'pageTitle' => 'Aula Virtual | Educación Financiera',
            'user'      => Session::user(),
        ], 'main');
    }

    public function recursos(): void {
        $this->view('pages/recursos', [
            'pageTitle' => 'Recursos y Herramientas | Educación Financiera',
            'user'      => Session::user(),
        ], 'main');
    }

    public function reticula(): void {
        $this->view('pages/reticula', [
            'pageTitle' => 'Retícula Académica | Educación Financiera',
            'user'      => Session::user(),
        ], 'main');
    }

    public function metas(): void {
        $this->view('pages/metas', [
            'pageTitle' => 'Mis Metas Financieras | Educación Financiera',
            'user'      => Session::user(),
        ], 'main');
    }

    public function configuraciones(): void {
        $this->view('pages/configuraciones', [
            'pageTitle' => 'Configuración de Perfil | Educación Financiera',
            'user'      => Session::user(),
        ], 'main');
    }

    public function suscripcion(): void {
        $this->view('pages/suscripcion', [
            'pageTitle' => 'Planes y Membresías | Educación Financiera',
            'user'      => Session::user(),
        ], 'main');
    }
}
