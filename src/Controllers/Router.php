<?php
namespace App\Controllers;

class Router
{
    /**
     * @var PostController
     */
    private $postController;
    private $commentController;
    private $userController;

    public function __construct()
    {
        $this->postController = new PostController();
        $this->commentController = new CommentController();
        $this->userController = new UserController();
    }

    private function routeChapters($id){
        $this->postController->chapterList();
    }

    public function run()
    {
        $page = 'home';
        $access = filter_input(INPUT_GET, 'page');

        $getId = null;
        $chapter = filter_input(INPUT_GET, 'id');

        if(ISSET($access)) {
            $page = $access;
        }

        if(ISSET($chapter) && is_numeric($chapter)) {
            $getId = $chapter;
        }


        switch ($page) {
            case "chapters" :
                $this->postController->chapterList();
                break;

            case "chapter" :
                $this->postController->displayPost($getId);
                break;

            case "inscription" :
                $this->userController->inscription();
                break;

            case "sendInscription" :
                $this->userController->addUser();
                break;

            case "sendConnection" :
                $this->userController->connection();
                break;

            case "deConnect" :
                $this->userController->deconnection();
                break;

            case 'delUser' :
                $this->userController->delUser($getId);
                break;

            case "admin" :
                if($_SESSION['rank'] === 'Admin') {
                    $this->userController->displayAdmin();
                    exit;
                }
                $this->postController->errorChapter();
                break;

            case "addPost" :
                $this->postController->addPost();
                break;

            case "deletePost" :
                $this->postController->deletePost($getId);
                break;

            case "modifPost" :
                $this->postController->getModifPage($getId);
                break;

            case "updatePost" :
                $this->postController->updatePost($getId);
                break;

            case "reportComment" :
                $this->commentController->reportComment($getId);
                break;

            case "valCom" :
                $this->commentController->validateComment($getId);
                break;

            case "delCom" :
                $this->commentController->deleteComment($getId);
                break;

            case "sendCom" :
                $this->commentController->addComment($getId);
                break;

            case "error" :
                $this->postController->errorChapter();
                break;

            default :
                $this->postController->lastChapter();
                break;
        }
    }
}