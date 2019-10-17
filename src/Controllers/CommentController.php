<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Controllers\PostsController;
use Twig\Environment;

class CommentController extends Controller
{
    function addComment($id)
    {
        $author = filter_input(INPUT_POST, 'pseudo');
        $comment = filter_input(INPUT_POST, 'comment');

        $commentManager = new CommentManager();
        $commentManager->addComment($id, $author, $comment);

        return $commentManager = "OK";
    }
}