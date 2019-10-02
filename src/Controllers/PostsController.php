<?php
namespace App\Controllers;

use App\Models\PostsManager;

class PostsController extends Controller {

    function lastPost() {
        $id_post= 1;
        $postManager = new PostsManager();
        $lastPosts = $postManager->getLastPost($id_post);
        echo $this->render('chapter.twig', ['posts' => $lastPosts]);
    }

    function chapterList() {
        $postManager = new PostsManager();
        $listPosts = $postManager->getChapterList();
        echo $this->render('chapterList.twig', ['posts' => $listPosts]);

    }
}