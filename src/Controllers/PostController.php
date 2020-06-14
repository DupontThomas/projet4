<?php
namespace App\Controllers;

use App\Configuration;
use App\Models\CommentManager;
use App\Models\PostManager;

class PostController extends Controller
{
    private $postManager;
    private $commentManager;

    public function __construct()
    {
        parent::__construct();

        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function displayPost($id_post)
    {
        $checkPost = $this->postManager->checkPost($id_post);

        if($checkPost[0] > 0) {
            $lastPosts = $this->postManager->getReadPost($id_post);
            $listComment = $this->commentManager->getComment($id_post);
            $this->display('chapter.twig', ['contents' => $lastPosts, 'comments' => $listComment]);
            return;
        }
            $this->errorChapter();
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

        header("Location:" . Configuration::URL . "public/index.php");
    }
    public function deletePost($id_post)
    {
        $this->postManager->deletePost($id_post);
        $this->commentManager->deleteCommentList($id_post);

        header("Location:" . Configuration::URL . "public/index.php");
    }

    public function getModifPage($id_post)
    {
        $getPost = $this->postManager->getReadPost($id_post);
        $this->display('modify.twig', ['contents' => $getPost]);
    }

    public function updatePost($id_post)
    {
        $title = filter_input(INPUT_POST, 'titleUpdatePost');
        $content = filter_input(INPUT_POST, 'contentUpdatePost');

        $this->postManager->updatePost($title,$content,$id_post);

        header("Location:" . Configuration::URL . "public/index.php");
    }

    public function errorChapter()
    {
        $this->display('error.twig');
    }
}