<?php
namespace App\Controllers;

use App\Configuration;
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

        header("Location:" . Configuration::URL . "public/?page=admin");
        exit;
    }
}