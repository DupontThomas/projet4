<?php
namespace App\Controllers;

use http\Env\Request;

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

    public function run()
    {
        $page = 'home';
        $access = filter_input(INPUT_GET, 'page');

        $getId = null;
        $chapter = filter_input(INPUT_GET, 'id');

        if(isset($access)) {
            $page = $access;
        }

        if(isset($chapter) && is_numeric($chapter)) {
            $getId = $chapter;
        }

//split the router into several pieces

        if ((preg_match ('/Post/', $page)) === 1 || (preg_match ('/chapter/', $page)) === 1)  {
            $this->routePost($page, $getId);
        } elseif ((preg_match ('/Com/', $page)) === 1) {
            $this->routeCom($page, $getId);
        } elseif ((preg_match ('/nscription/', $page)) === 1 || (preg_match ('/Connect/', $page)) === 1) {
            $this->routeLog($page);
        } else {
            switch ($page) {

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

                case "error" :
                    $this->postController->errorChapter();
                    break;

                default :
                    $this->postController->lastChapter();
                    break;
            }
        }
    }
    public function routePost($page, $getId) {

        switch ($page) {

            case "chapters" :
                $this->postController->chapterList();
                break;

            case "chapter" :
                $this->postController->displayPost($getId);
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
        }
    }

    public function routeCom($page, $getId) {

        switch ($page) {

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
        }
    }

    public function routeLog($page) {

        switch ($page) {

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
        }
    }
}