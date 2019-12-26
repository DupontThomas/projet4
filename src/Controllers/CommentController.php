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

    public function warningComment()
    {
        $idComment = $comment = filter_input(INPUT_POST, 'idComment');

        $commentManager = new CommentManager();
        $commentManager->warningComment($idComment);

        $this->alert('Votre signalement a été transmis a bien été transmis.');

        return $warningComment = "OK";
    }
}