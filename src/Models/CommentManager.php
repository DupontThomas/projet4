<?php
namespace App\Models;

class CommentManager extends Manager {

    public function getComment($id_post) {

        $req = $this->dbConnect()->prepare("SELECT id, author, comment, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%imin%ss') AS date_publication_fr FROM comments WHERE id_post=? ORDER BY id");
        $req->execute(array($id_post));
        $listComments = $req->fetchAll();
        return $listComments;
    }
}
