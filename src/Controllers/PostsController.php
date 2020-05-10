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
        $checkPost = $this->postManager->checkPost($id);

        if($checkPost[0] > 0) {
            $lastPosts = $this->postManager->getReadPost($id);
            $listComment = $this->commentManager->getComment($id);
            $this->display('chapter.twig', ['contents' => $lastPosts, 'comments' => $listComment]);
        } else {
            $this->errorChapter();
        }
    }

    public function chapterList()
    {
        $listPosts = $this->postManager->getPostList();
        $this->display('chapterList.twig', ['contents' => $listPosts]);
    }

    public function lastChapter()
    {
        $lastChapter = $this->postManager->getLastPost();
        $this->display('home.twig', ['contents' => $lastChapter]);
    }

    public function addPost()
    {
        $title = filter_input(INPUT_POST, 'titleNewPost');
        $content = filter_input(INPUT_POST, 'contentNewPost');
        $this->postManager->addPost($title,$content);

        header("Location: http://localhost/projet4/public/index.php");
    }
    public function deletePost($id)
    {
        $this->postManager->deletePost($id);
        $this->commentManager->deleteCommentList($id);

        header("Location: http://localhost/projet4/public/index.php");
    }

    public function getModifPage($id)
    {
        $getPost = $this->postManager->getReadPost($id);
        $this->display('modify.twig', ['contents' => $getPost]);
    }

    public function updatePost($id)
    {
        $title = filter_input(INPUT_POST, 'titleUpdatePost');
        $content = filter_input(INPUT_POST, 'contentUpdatePost');

        $this->postManager->updatePost($title,$content,$id);

        header("Location: http://localhost/projet4/public/index.php");
    }

    public function errorChapter()
    {
        $this->display('error.twig');
    }
}