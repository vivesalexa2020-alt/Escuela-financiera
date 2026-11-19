<?php
/**
 * Rutas web - páginas que renderizan HTML.
 * Recibe una instancia de Router y registra las rutas sobre ella.
 */

use App\Core\Router;

return static function (Router $router): void {
    // Rutas web (acepta tanto /home como index.php?page=home).
    $router->get('/',              'PageController@home');
    $router->get('/home',          'PageController@home');
    $router->get('/index.php',     'PageController@home');
    $router->get('/aula',          'PageController@aula');
    $router->get('/recursos',      'PageController@recursos');
    $router->get('/reticula',      'PageController@reticula');
    $router->get('/metas',         'PageController@metas');
    $router->get('/configuraciones','PageController@configuraciones');
    $router->get('/suscripcion',   'PageController@suscripcion');

    // Panel de administración (protegido por rol admin en el controlador)
    $router->get('/admin',                        'AdminController@dashboard');
    $router->get('/admin/exportar-pdf',           'AdminController@exportPdf');
    $router->get('/admin/exportar',               'AdminController@exportCsv');
    $router->post('/admin/usuarios/crear',        'AdminController@createUser');
    $router->post('/admin/usuarios/editar',       'AdminController@editUser');
    $router->post('/admin/usuarios/rol',          'AdminController@updateRole');
    $router->post('/admin/usuarios/estado',       'AdminController@updateStatus');
    $router->post('/admin/usuarios/eliminar',     'AdminController@deleteUser');
    $router->post('/admin/cursos/crear',          'AdminController@createCourse');
    $router->post('/admin/cursos/actualizar',     'AdminController@updateCourse');
    $router->post('/admin/cursos/eliminar',       'AdminController@deleteCourse');
    $router->post('/admin/lecciones/crear',       'AdminController@createLesson');
    $router->post('/admin/lecciones/actualizar',  'AdminController@updateLesson');
    $router->post('/admin/lecciones/eliminar',    'AdminController@deleteLesson');
    $router->post('/admin/libros/crear',          'AdminController@createBook');
    $router->post('/admin/libros/actualizar',     'AdminController@updateBook');
    $router->post('/admin/libros/eliminar',       'AdminController@deleteBook');
    $router->post('/admin/audios/crear',          'AdminController@createAudio');
    $router->post('/admin/audios/actualizar',     'AdminController@updateAudio');
    $router->post('/admin/audios/eliminar',       'AdminController@deleteAudio');
    $router->post('/admin/ejercicios/crear',      'AdminController@createExercise');
    $router->post('/admin/ejercicios/actualizar', 'AdminController@updateExercise');
    $router->post('/admin/ejercicios/eliminar',   'AdminController@deleteExercise');
    $router->post('/admin/membresias/actualizar', 'AdminController@updateMembership');
    $router->post('/admin/logros/crear',          'AdminController@createLogro');
    $router->post('/admin/logros/estado',         'AdminController@updateLogroStatus');
    $router->post('/admin/logros/eliminar',       'AdminController@deleteLogro');
    $router->post('/admin/configuracion',         'AdminController@updateSettings');
    $router->post('/admin/password',              'AdminController@updatePassword');
};
