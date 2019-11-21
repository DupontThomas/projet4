<?php
namespace App\Models;

class PostsManager extends Manager
{
    public function getLastPost()
    {
        $req = $this->dbConnect()->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts ORDER BY id DESC LIMIT 1");
        $req->execute();
        $lastPost = $req->fetch();

        return $lastPost;
    }

    public function getPostList()
    {
        $req = $this->dbConnect()->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts ORDER BY id DESC");
        $req->execute();
        $listPosts = $req->fetchAll();

        return $listPosts;
    }

    public function checkPost($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT COUNT(id) FROM posts WHERE id=?");
        $req->execute(array($id_post));
        $checkPost = $req->fetch();

        return $checkPost;
    }

    public function getReadPost($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts WHERE id=?");
        $req->execute(array($id_post));
        $readPost = $req->fetch();

        return $readPost;
    }

    public function addPost($title, $content)
    {
        $req = $this->dbConnect()->prepare("INSERT INTO posts (id, title, content, creation_date) VALUES (NULL, ?, ?, CURRENT_TIME())");
        $newPost = $req->execute(array($title, $content));

        return $newPost;
    }

    public function deletePost($id)
    {
        $reqPost = $this->dbConnect()->prepare("DELETE FROM posts WHERE id=?");
        $deletePost = $reqPost->execute(array($id));

        $reqComment = $this->dbConnect()->prepare(" DELETE FROM comments WHERE id_post=?");
        $reqComment->execute(array($id));

        return $deletePost;
    }
}