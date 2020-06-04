<?php
namespace App\Controllers;

use App\Models\CommentManager;

class CommentController extends Controller
{
    public function addComment($id_post)
    {
        $author = $_SESSION['pseudo'];
        $comment = filter_input(INPUT_POST, 'comment');

        $commentManager = new CommentManager();
        $commentManager->addComment($id_post, $author, $comment);

        header("Location:?page=chapter&id=" . $id_post);

        return;
    }

    public function reportComment($id_post)
    {
        $idComment = filter_input(INPUT_POST, 'idComment');

        $commentManager = new CommentManager();
        $commentManager->reportComment($idComment);

        header("Location:?page=chapter&id=" . $id_post);

        return;
    }

    public function validateComment($id_post)
    {
        $commentManager = new CommentManager();
        $commentManager->validateComment($id_post);

        header("Location: ?page=admin");
    }

    public function deleteComment($id_post)
    {
        $commentManager = new CommentManager();
        $commentManager->deleteComment($id_post);

        header("Location: ?page=admin");
    }
}