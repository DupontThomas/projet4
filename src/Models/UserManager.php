<?php
namespace App\Models;

/**
 * Class UserManager
 * @package App\Models
 */
class UserManager extends Manager
{
    /**
     * @param $pseudo
     * @param $email
     * @param $password
     * @return bool
     */
    public function addUser($pseudo, $email, $password)
    {
        $req = $this->dbConnect()->prepare('INSERT INTO users(pseudo, pass, mail, rank, date_inscription) VALUES( ?, ?, ?, "Membre", CURRENT_TIME())');
        $newUser = $req->execute(array( $pseudo, $password, $email ));

        return $newUser;
    }

    /**
     * @param $pseudo
     * @return mixed
     */
    public function checkPseudo($pseudo)
    {
        $req = $this->dbConnect()->prepare("SELECT COUNT(pseudo) FROM users WHERE pseudo=?");
        $req->execute(array($pseudo));
        $checkPseudo = $req->fetch();

        return $checkPseudo;
    }

    /**
     * @param $pseudo
     * @return mixed
     */
    public function checkUser($pseudo)
    {
        $req = $this->dbConnect()->prepare("SELECT pseudo, pass, rank FROM users WHERE pseudo=?");
        $req->execute(array($pseudo));
        $checkUser = $req->fetch(\PDO::FETCH_ASSOC);

        return $checkUser;
    }

    /**
     * @return array
     */
    public function listUser()
    {
        $req = $this->dbConnect()->prepare("SELECT id, pseudo, rank, date_inscription FROM users ORDER BY rank");
        $req->execute();
        $listUser = $req->fetchAll();

        return $listUser;
    }

    /**
     * @param $id_user
     */
    public function delUser($id_user)
    {
        $req = $this->dbConnect()->prepare("DELETE FROM users WHERE id=?");
        $req->execute(array($id_user));

        return;
    }
}
