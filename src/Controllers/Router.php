<?php
namespace App\Controllers;

class Router
{
    /**
     * @var PostsController
     */
    private $postsController;
    private $commentController;
    private $userController;

    public function __construct()
    {
        $this->postsController = new PostsController();
        $this->commentController = new CommentController();
        $this->userController = new UserController();
    }

    public function run()
    {
        $page = 'home';
        $access = filter_input(INPUT_GET, 'page');

        $id_post = null;
        $chapter = filter_input(INPUT_GET, 'id');

        if(ISSET($access)) {
            $page = $access;
        }

        if(ISSET($chapter) && is_numeric($chapter)) {
            $id_post = $chapter;
        }

        switch ($page) {
            case "chapters" :
                $this->postsController->chapterList();
                break;

            case "chapter" :
                $this->postsController->displayPost($id_post);
                break;

            case "inscription" :
                $this->userController->inscription();
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
                $this->commentController->addComment($id_post);
                break;

            case "admin" :
                if($_SESSION['rank'] === 'Admin') {
                $this->userController->displayAdmin();
                exit;
                }
                $this->postsController->errorChapter();
                break;

            case "addPost" :
                $this->postsController->addPost();
                break;

            case "deletePost" :
                $this->postsController->deletePost($id_post);
                break;

            case "modifPost" :
                $this->postsController->getModifPage($id_post);
                break;

            case "updatePost" :
                $this->postsController->updatePost($id_post);
                break;

            case "reportComment" :
                $this->commentController->reportComment($id_post);
                break;

            case "valcom" :
                $this->commentController->validateComment($id_post);
                break;

            case "delcom" :
                $this->commentController->deleteComment($id_post);
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
