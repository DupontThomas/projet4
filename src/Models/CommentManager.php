<?php


namespace App\models;

use Config\DbConnection;

class CommentManager extends DbConnection
{
    function getComment($id_post) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(date_publication, \'%d/%m/%Y à %Hh%imin%ss\') AS date_publication_fr FROM comments WHERE id_post=? ORDER BY id DESC');
        $req->execute(array($id_post));
        $listComments = $req->fetch();
        return $listComments;
    }


}