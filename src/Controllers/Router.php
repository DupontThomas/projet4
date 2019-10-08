<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Router
{
    /**
     * @var PostsController
     */
    private $postsController;

    public function __construct(PostsController $postsController)
    {
        $this->postsController = $postsController;
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

        if(ISSET($chapter)) {
            $id = $chapter;
        }


        switch ($page) {
            case "chapters" :
                $this->postsController->chapterList();
                break;

            case "chapter" :
                $this->postsController->displayPost($id);
                break;

            default :
                $this->postsController->lastChapter();
                break;
        }
    }
}
