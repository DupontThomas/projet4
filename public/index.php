<?php

use App\Controllers\CommentController;
use App\Controllers\PostsController;
use App\Controllers\Router;
use App\Controllers\UserController;
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
$postController= new PostsController($twig);
$commentController = new CommentController($twig);
$userController = new UserController($twig);

$router = new Router($postController,$commentController,$userController);
$router->run();
