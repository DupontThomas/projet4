<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\PostsManager;
use Twig\Environment;

class PostsController extends Controller
{
    private $postManager = null;
    private $commentManager = null;

    public function __construct(Environment $twig)
    {
        parent::__construct($twig);

        $this->postManager = new PostsManager();
        $this->commentManager = new CommentManager();
    }

    public function displayPost($id)
    {
        $countPosts = $this->postManager->getCountPost();
        if(is_numeric($id) && $id < $countPosts[0]) {
            $lastPosts = $this->postManager->getReadPost($id);
            $listComment = $this->commentManager->getComment($id);

            echo $this->render('chapter.twig', ['posts' => $lastPosts, 'comments' => $listComment]);
        }
        else {
            echo $this->render('error.twig');
        }
    }

    public function chapterList()
    {
        $listPosts = $this->postManager->getPostList();
        echo $this->render('chapterList.twig', ['posts' => $listPosts]);

    }

    public function lastChapter()
    {
        $lastChapter = $this->postManager->getLastPost();
        echo $this->render('home.twig', ['posts' => $lastChapter]);
    }

    public function errorChapter()
    {
    }
}