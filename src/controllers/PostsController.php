<?php
namespace App\Controllers;

use App\Models\PostsManager;



class PostsController {

    function lastPost() {

        $postManager = new PostsManager();
        $lastPost = $postManager->getLastPost();
        return $lastPost;
    }

}