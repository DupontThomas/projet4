<?php
namespace App\Models;

class CommentManager extends Manager
{
    public function getComment($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT id, author, comment, report, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%imin%ss') AS date_publication_fr FROM comments WHERE id_post=? ORDER BY id");
        $req->execute(array($id_post));
        $listComments = $req->fetchAll();

        return $listComments;
    }

    public function addComment($id, $author, $comment)
    {
        $req = $this->dbConnect()->prepare("INSERT INTO comments (id, id_post, author, comment, report, date_publication) VALUES (NULL, ?, ?, ?, 0, CURRENT_TIME())");
        $req->execute(array($id, $author, $comment));

        return "OK";
    }

    public function deleteCommentList($id_post)
    {
        $req = $this->dbConnect()->prepare(" DELETE FROM comments WHERE id_post=?");
        $req->execute(array($id_post));

        return "OK";
    }

    public function reportComment($idComment)
    {
        $req = $this->dbConnect()->prepare(" UPDATE comments SET report = '1' WHERE id=?");
        $req->execute(array($idComment));

        return "OK";
    }

    public function reportedComment()
    {
        $req = $this->dbConnect()->prepare("SELECT id, id_post, author, comment, report, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%imin%ss') AS date_publication_fr FROM comments WHERE report=1 ORDER BY id");
        $req->execute();
        $listReportedComment = $req->fetchAll();

        return $listReportedComment;
    }

    public function validateComment($id)
    {
        $req = $this->dbConnect()->prepare(" UPDATE comments SET report = '0' WHERE id=?");
        $req->execute(array($id));

        return "OK";
    }

    public function deleteComment($id)
    {
        $req = $this->dbConnect()->prepare(" DELETE FROM comments WHERE id=?");
        $req->execute(array($id));

        return "OK";
    }
}
