<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\PostsManager;

class CommentController extends Controller {
    function addComment($id) {

        $author = filter_input(INPUT_POST, 'pseudo');
        $comment = filter_input(INPUT_POST, 'comment');

        $commentManager = new CommentManager();
        $commentManager->addComment($id, $author, $comment);
        $comments = $commentManager->getComment($id);

        $postManager = new PostsManager();
        $post = $postManager->getReadPost($id);

        return $this->render('chapter.twig', ['contents' =>$post,'comments' => $comments]);
    }
}