<?php
namespace App\Controllers;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Router {
    public function run() {
        $loader = new FilesystemLoader( '../src/Views');
        $twig = new Environment($loader, [
            'cache' => false,
            //'debug' => false
        ]);

        $comment = new CommentController($twig);
        $comment->displayComment();

        $post = new PostsController($twig);
        $post->lastPost();

    }
}