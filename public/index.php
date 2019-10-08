<?php
use App\Controllers\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Tracy\Debugger;

require_once '../vendor/autoload.php';

session_start();

Debugger::enable();

$get=$_GET;

$loader = new FilesystemLoader( '../src/Views');
$twig = new Environment($loader, [
    'cache' => false,
    //'debug' => false
]);

$postcontroller= new \App\Controllers\PostsController($twig);
$router = new Router($postcontroller);
$router->run();
