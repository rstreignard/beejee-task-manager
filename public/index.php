<?php 

require '../vendor/autoload.php';

require '../helpers/session_helper.php';
require '../helpers/sortable_helper.php';

$router = new Core\Router();

$router->add('', ['controller' => 'Tasks', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);