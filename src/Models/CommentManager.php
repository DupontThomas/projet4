<?php
namespace App\Models;

/**
 * Class CommentManager
 * @package App\Models
 */
class CommentManager extends Manager
{
    /**
     * @param $id_post
     * @return array
     */
    public function getComment($id_post)
    {
        $req = $this->dbConnect()->prepare("SELECT id, author, comment, report, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%imin%ss') AS date_publication_fr FROM comments WHERE id_post=? ORDER BY id");
        $req->execute(array($id_post));
        $listComments = $req->fetchAll();

        return $listComments;
    }

    /**
     * @param $id_post
     * @param $author
     * @param $comment
     */
    public function addComment($id_post, $author, $comment)
    {
        $req = $this->dbConnect()->prepare("INSERT INTO comments (id, id_post, author, comment, report, date_publication) VALUES (NULL, ?, ?, ?, 0, CURRENT_TIME())");
        $req->execute(array($id_post, $author, $comment));

        return;
    }

    /**
     * @param $id_post
     */
    public function deleteCommentList($id_post)
    {
        $req = $this->dbConnect()->prepare(" DELETE FROM comments WHERE id_post=?");
        $req->execute(array($id_post));

        return;
    }

    /**
     * @param $idComment
     */
    public function reportComment($idComment)
    {
        $req = $this->dbConnect()->prepare(" UPDATE comments SET report = '1' WHERE id=?");
        $req->execute(array($idComment));

        return;
    }

    /**
     * @return array
     */
    public function reportedComment()
    {
        $req = $this->dbConnect()->prepare("SELECT id, id_post, author, comment, report, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%imin%ss') AS date_publication_fr FROM comments WHERE report=1 ORDER BY id");
        $req->execute();
        $listReportedComment = $req->fetchAll();

        return $listReportedComment;
    }

    /**
     * @param $idComment
     */
    public function validateComment($idComment)
    {
        $req = $this->dbConnect()->prepare(" UPDATE comments SET report = '0' WHERE id=?");
        $req->execute(array($idComment));

        return;
    }

    /**
     * @param $idComment
     */
    public function deleteComment($idComment)
    {
        $req = $this->dbConnect()->prepare(" DELETE FROM comments WHERE id=?");
        $req->execute(array($idComment));

        return;
    }
}
