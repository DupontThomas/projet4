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

    public function getCountPost()
    {
        $req = $this->dbConnect()->prepare("SELECT COUNT(id) FROM posts");
        $req->execute();
        $countPost = $req->fetch();
        return $countPost;
    }

    public function getReadPost($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts WHERE id=?");
        $req->execute(array($id_post));
        $readPost = $req->fetch();
        return $readPost;
    }
}