<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\PostsManager;

class PostsController extends Controller {

    function displayPost() {
        $id_post= $_GET['id'];
        $postManager = new PostsManager();
        $lastPosts = $postManager->getLastPost();
        $commentManager = new CommentManager();
        $listComment = $commentManager->getComment($id_post);

        echo $this->render('chapter.twig', ['posts' => $lastPosts, 'comments' => $listComment]);
    }

    function chapterList() {
        $postManager = new PostsManager();
        $listPosts = $postManager->getPostList();
        echo $this->render('chapterList.twig', ['posts' => $listPosts]);

    }
}