<?php

namespace App\Models;


use Config\DbConnection;

class PostsManager extends DbConnection {

    function getLastChapter {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY id DESC LIMIT 1');
        $req->execute();
        $lastChapter = $req->fetch();
        return $lastChapter;
    }

}