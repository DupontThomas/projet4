<?php
namespace App\Controllers;

use App\Models\PostsManager;

class PostsController extends Controller {

    function lastPost() {
        $id_post= $_GET['id'];
        $postManager = new PostsManager();
        $lastPosts = $postManager->getLastPost($id_post);
        echo $this->render('chapter.twig', ['post' => $lastPosts]);
    }
}