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

    public function run()
    {
        $page = 'home';
        $access = filter_input(INPUT_GET, 'page');

        $id_post = null;
        $chapter = filter_input(INPUT_GET, 'id');

        $toDo = null;
        $action = filter_input(INPUT_GET,'action');

        if(ISSET($access)) {
            $page = $access;
        }

        if(ISSET($chapter) && is_numeric($chapter)) {
            $id_post = $chapter;
        }

        if(ISSET($action)) {
            $toDo = $action;
        }

        switch ($page) {
            case "chapters" :
                $this->postController->chapterList();
                break;

            case "chapter" :
                $this->postController->displayPost($id_post);
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
                $this->postController->errorChapter();
                break;

            case "addPost" :
                $this->postController->addPost();
                break;

            case "deletePost" :
                $this->postController->deletePost($id_post);
                break;

            case "modifPost" :
                $this->postController->getModifPage($id_post);
                break;

            case "updatePost" :
                $this->postController->updatePost($id_post);
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

            case 'delUser' :
                $id_user = $id_post;
                $this->userController->delUser($id_user);
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
