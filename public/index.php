<?php
session_start();
use App\Controllers\Router;

require_once '../vendor/autoload.php';

use Tracy\Debugger;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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
