<?php
namespace App\Controllers;

class Router
{
    /**
     * @var PostsController
     */
    private $postsController;

    public function __construct(PostsController $postsController, CommentController $commentController, UserController $userController)
    {
        $this->postsController = $postsController;
        $this->commentController = $commentController;
        $this->userController = $userController;
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

            case "inscription" :
                $this->userController->display();
                break;

            case "sendinscription" :
                $this->userController->addUser();
                break;

            case "sendconnection" :
                $this->userController->connection();
                break;

            case "delog" :
                $this->userController->deconnection();
                break;

            case "sendcom" :
                $this->commentController->addComment($id);
                if( $addcomment = "OK") {
                    echo '<meta http-equiv="refresh" content="0;URL=http://localhost/projet4/public/?page=chapter&id=' . $id . '">';
                }
                break;

            case "admin" :
                if($_SESSION['rank'] === 'Admin') {
                $this->userController->displayAdmin();
                } else {$this->postsController->errorChapter();
                }
                break;

            case "addPost" :
                $this->postsController->addPost();
                break;

            case "deletePost" :
                $this->postsController->deletePost($id);
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
