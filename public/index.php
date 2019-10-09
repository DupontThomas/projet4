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

$postController= new \App\Controllers\PostsController($twig);
$commentController = new \App\Controllers\CommentController($twig);

$router = new Router($postController,$commentController);
$router->run();
