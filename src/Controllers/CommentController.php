<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Controllers\PostsController;
use Twig\Environment;

class CommentController extends Controller
{
    function addComment($id)
    {
        $author = $_SESSION['pseudo'];
        $comment = filter_input(INPUT_POST, 'comment');

        $commentManager = new CommentManager();
        $commentManager->addComment($id, $author, $comment);

        return $addcomment = "OK";
    }
}