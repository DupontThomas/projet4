<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\PostManager;

/**
 * Class PostController
 * @package App\Controllers
 */
class PostController extends Controller
{
    /**
     * @var \App\Models\PostManager
     * @var \App\Models\CommentManager
     */
    private $postManager;
    private $commentManager;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    /**
     * @param $id_post
     */
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

        $this->refresh("index.php");
    }

    /**
     * @param $id_post
     */
    public function deletePost($id_post)
    {
        $this->commentManager->deleteCommentList($id_post);
        $this->postManager->deletePost($id_post);

        $this->refresh("index.php");
    }

    /**
     * @param $id_post
     */
    public function getModifPage($id_post)
    {
        $getPost = $this->postManager->getReadPost($id_post);
        $this->display('modify.twig', ['contents' => $getPost]);
    }

    /**
     * @param $id_post
     */
    public function updatePost($id_post)
    {
        $title = filter_input(INPUT_POST, 'titleUpdatePost');
        $content = filter_input(INPUT_POST, 'contentUpdatePost');

        $this->postManager->updatePost($title,$content,$id_post);

        $this->refresh("index.php");
    }

    public function errorChapter()
    {
        $this->display('error.twig');
    }
}