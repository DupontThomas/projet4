<?php

use App\Configuration;
use App\Controllers\CommentController;
use App\Controllers\PostsController;
use App\Controllers\Router;
use App\Controllers\UserController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Tracy\Debugger;

error_reporting(E_ALL);
ini_set("display_errors",1);

require_once '../vendor/autoload.php';

session_start();

//Debugger::enable();

$loader = new FilesystemLoader( '../src/Views');
$twig = new Environment($loader, [
    'cache' => false,
    //'debug' => false
]);
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('url', new Configuration());
$postController= new PostsController($twig);
$commentController = new CommentController($twig);
$userController = new UserController($twig);

$router = new Router($postController,$commentController,$userController);
$router->run();
