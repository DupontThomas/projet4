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

        header("Location:?page=chapter&id=" . $id);

        return $addComment = "OK";
    }

    public function reportComment($id)
    {
        $idComment = filter_input(INPUT_POST, 'idComment');

        $commentManager = new CommentManager();
        $commentManager->reportComment($idComment);

     /*   $this->alert('Votre signalement a été transmis.'); */

        header("Location:?page=chapter&id=" . $id);

        return $reportComment = "OK";
    }

    public function validateComment($id)
    {
        $commentManager = new CommentManager();
        $commentManager->validateComment($id);
        header("Location: ?page=admin");
        exit;
    }

    public function deleteComment($id)
    {
        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);

        header("Location: http://localhost/projet4/public/?page=admin");
        exit;
    }
}