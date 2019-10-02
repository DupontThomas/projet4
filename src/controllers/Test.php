<?php
namespace App\controllers;

require "CommentController.php";

$loader = new \Twig\Loader\FilesystemLoader('../src/views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$comment= new Commentcontroller();
$comm = $comment-> displayComment();

echo $twig->render('home.twig', ['comments' => 'kiki']);
