<?php

use App\Core\Router;

$router = new Router();

// Rutas web (acepta tanto /cursos como index.php?page=cursos).
$router->get('/', 'PageController@home');
$router->get('/home', 'PageController@home');
$router->get('/index.php', 'PageController@home');
$router->get('/cursos', 'PageController@cursos');
$router->get('/aula', 'PageController@aula');
$router->get('/recursos', 'PageController@recursos');
$router->get('/reticula', 'PageController@reticula');
$router->get('/metas', 'PageController@metas');
$router->get('/configuraciones', 'PageController@configuraciones');
$router->get('/suscripcion', 'PageController@suscripcion');

return $router;
