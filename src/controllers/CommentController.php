<?php


namespace App\controllers;
use App\Models\CommentManager;

class CommentController
{

    function displayComment() {
        $id_post= $_GET['id'];
        $commentManager = new CommentManager();
        $comments=$commentManager->getComment($id_post);
        return $comments

    }

}