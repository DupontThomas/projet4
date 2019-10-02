<?php
namespace App\Models;


class PostsManager extends Manager {

    function getLastPost($id_post) {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts WHERE id=?");
        $req->execute(array($id_post));
        $lastPost = $req->fetchAll();
        return $lastPost;
    }

    function getChapterList() {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS postDate FROM posts ORDER BY id DESC");
        $req->execute();
        $listPosts = $req->fetchAll();
        return $listPosts;
    }
}