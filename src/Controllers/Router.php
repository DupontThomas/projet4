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
        if (ISSET($_GET['id'])) {
            if ($_GET === 'home') {
                $this->postsController->chapterList();
            } else if (is_numeric($_GET)) {
                $this->postsController->displayPost();
            } else {
                $this->postsController->chapterList();
            }
        }
    }
}
