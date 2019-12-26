<?php
namespace App\Models;

class CommentManager extends Manager
{
    public function getComment($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT id, author, comment, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%imin%ss') AS date_publication_fr FROM comments WHERE id_post=? ORDER BY id");
        $req->execute(array($id_post));
        $listComments = $req->fetchAll();
        return $listComments;
    }

    public function addComment($id, $author, $comment)
    {
        $req = $this->dbConnect()->prepare("INSERT INTO comments (id, id_post, author, comment, date_publication) VALUES (NULL, ?, ?, ?, CURRENT_TIME())");
        $newComment = $req->execute(array($id, $author, $comment));
        return $newComment;
    }

    public function deleteCommentList($id_post)
    {
        $req = $this->dbConnect()->prepare(" DELETE FROM comments WHERE id_post=?");
        $deleteCommentList = $req->execute(array($id_post));
        
        return $deleteCommentList;
    }

    public function warningComment($idComment)
    {
        $req = $this->dbConnect()->prepare(" UPDATE comments SET warning = '1' WHERE id=?");
        $warningComment = $req->execute(array($idComment));

        return $warningComment;
    }

}
