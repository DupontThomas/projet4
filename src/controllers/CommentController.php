<?php
namespace App\controllers;


use App\models\CommentManager;
require('../models/CommentManager.php');

class CommentController {

    function displayComment() {

        $id_post= 1;
        $commentManager = new CommentManager();
        $comments=$commentManager->getComment($id_post);
        return $comments;



    }

}