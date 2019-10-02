<?php
namespace App\Controllers;

use App\Models\CommentManager;

class CommentController {
    function displayComment() {

        $id_post= 1;
        $commentManager = new CommentManager();
        $comments=$commentManager->getComment($id_post);
        return $comments;
    }
}