<?php

use Router\Router;
use Symfony\Component\Yaml\Yaml;

session_start();

require __DIR__ . '/vendor/autoload.php';

//require('config/config.php');
$config = Yaml::parse(file_get_contents('config/config.yml'));

$loader = new Twig_Loader_Filesystem('views/');
$twig = new Twig_Environment($loader, array(
    // 'cache' => 'cache/twig/',
    'cache' => false,
));

/*
if (empty($_GET['action'])) {
    $action = 'home';
}
else {
    $action = $_GET['action'];
}

if (isset($routes[$action])) {
    require('controllers/'.$routes[$action].'_controller.php');
    call_user_func($action.'_action');
}
else {
    die('Illegal route');
}
*/

$router = new Router($config['routes'], $twig);
if (!empty($_GET['action']))
    $router->callAction($_GET['action']);
else
    $router->callAction($config['defaut_route']);

