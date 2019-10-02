<?php
namespace App\Controllers;

use App\Models\CommentManager;

class CommentController extends Controller {
    function displayComment() {

        $id_post= $_GET['id'];
        $commentManager = new CommentManager();
        $comments=$commentManager->getComment($id_post);
        echo $this->render('chapter.twig', ['comments' => $comments]);
    }
}