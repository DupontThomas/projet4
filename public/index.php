<?php
use App\Controllers\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Tracy\Debugger;

require_once '../vendor/autoload.php';

session_start();

Debugger::enable();

$loader = new FilesystemLoader( '../src/Views');
$twig = new Environment($loader, [
    'cache' => false,
    //'debug' => false
]);
$twig->addGlobal('session', $_SESSION);
$postController= new \App\Controllers\PostsController($twig);
$commentController = new \App\Controllers\CommentController($twig);
$userController = new \App\Controllers\UserController($twig);


$router = new Router($postController,$commentController,$userController);
$router->run();
