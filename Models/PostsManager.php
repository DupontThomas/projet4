<?php
namespace App\Models;


class PostsManager extends Manager {

    function getLastPost() {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY id DESC LIMIT 1');
        $req->execute();
        $lastPost = $req->fetch();
        return $lastPost;
    }
}