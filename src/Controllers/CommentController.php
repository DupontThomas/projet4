<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Controllers\PostsController;
use Twig\Environment;

class CommentController extends Controller
{
    public function addComment($id)
    {
        $author = $_SESSION['pseudo'];
        $comment = filter_input(INPUT_POST, 'comment');

        $commentManager = new CommentManager();
        $commentManager->addComment($id, $author, $comment);

        return $addComment = "OK";
    }

    public function reportComment()
    {
        $idComment = $comment = filter_input(INPUT_POST, 'idComment');

        $commentManager = new CommentManager();
        $commentManager->reportComment($idComment);

        $this->alert('Votre signalement a été transmis.');

        return $reportComment = "OK";
    }

    public function validateComment($id)
    {
        $commentManager = new CommentManager();
        $commentManager->validateComment($id);

        $this->redirect('../public/?page=admin');
    }

    public function deleteComment($id)
    {
        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);

        $this->redirect('../public/?page=admin');
    }
}