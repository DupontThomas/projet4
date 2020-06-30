<?php
namespace App\Models;

/**
 * Class PostManager
 * @package App\Models
 */
class PostManager extends Manager
{
    /**
     * @return mixed
     */
    public function getLastPost()
    {
        $req = $this->dbConnect()->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts ORDER BY id DESC LIMIT 1");
        $req->execute();
        $lastPost = $req->fetch();

        return $lastPost;
    }

    /**
     * @return array
     */
    public function getPostList()
    {
        $req = $this->dbConnect()->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts ORDER BY id DESC");
        $req->execute();
        $listPosts = $req->fetchAll();

        return $listPosts;
    }

    /**
     * @param $id_post
     * @return mixed
     */
    public function checkPost($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT COUNT(id) FROM posts WHERE id=?");
        $req->execute(array($id_post));
        $checkPost = $req->fetch();

        return $checkPost;
    }

    /**
     * @param $id_post
     * @return mixed
     */
    public function getReadPost($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts WHERE id=?");
        $req->execute(array($id_post));
        $readPost = $req->fetch();

        return $readPost;
    }

    /**
     * @param $title
     * @param $content
     * @return string
     */
    public function addPost($title, $content)
    {
        $req = $this->dbConnect()->prepare("INSERT INTO posts (id, title, content, creation_date) VALUES (NULL, ?, ?, CURRENT_TIME())");
        $req->execute(array($title, $content));

        return "OK";
    }

    /**
     * @param $id_post
     */
    public function deletePost($id_post)
    {
        $reqPost = $this->dbConnect()->prepare("DELETE FROM posts WHERE id=?");
        $reqPost->execute(array($id_post));

        return;
    }

    /**
     * @param $title
     * @param $content
     * @param $id_post
     */
    public function updatePost($title, $content, $id_post)
    {
        $req = $this->dbConnect()->prepare("UPDATE posts SET title= :new_title, content= :new_content where id= :id");
        $req->execute(array(
            'new_title' => $title,
            'new_content' => $content,
            'id' => $id_post
            ));

        return;
    }
}