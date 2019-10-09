<?php
namespace App\Controllers;

class Router
{
    /**
     * @var PostsController
     */
    private $postsController;

    public function __construct(PostsController $postsController, CommentController $commentController)
    {
        $this->postsController = $postsController;
        $this->commentController = $commentController;
    }


    public function run()
    {
        $page = 'home';
        $access = filter_input(INPUT_GET, 'page');

        $id = null;
        $chapter = filter_input(INPUT_GET, 'id');

        if(ISSET($access)) {
            $page = $access;
        }

        if(ISSET($chapter) && is_numeric($chapter)) {
            $id = $chapter;
        }

        switch ($page) {
            case "chapters" :
                $this->postsController->chapterList();
                break;

            case "chapter" :
                $this->postsController->displayPost($id);
                break;

            case "sendcom" :
                $this->commentController->addComment($id);
                break;

            case "error" :
                $this->postsController->errorChapter();
                break;

            default :
                $this->postsController->lastChapter();
                break;
        }
    }
}
