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
            if ($_GET['id'] === 1) {
                $this->postsController->displayPost(1);
            }
            else if($_GET['id']=== 2) {

                $this->postsController->displayPost(2);

            }
            else {
                $this->postsController->chapterList();
            }
        }
    }
}
