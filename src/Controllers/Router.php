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

        if($_GET['id'] === 'home') {
            $post = new PostsController($twig);
            $post->chapterList();
        }
        else {
            $post = new PostsController($twig);
            $post->lastPost();
        }



        //$comment = new CommentController($twig);
        //$comment->displayComment();



    }
}

/*

*/