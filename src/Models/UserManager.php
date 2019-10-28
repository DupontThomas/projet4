<?php
namespace App\Models;

class UserManager extends Manager
{
    public function addUser($pseudo, $email, $password)
    {
        $req = $this->dbConnect()->prepare('INSERT INTO users(pseudo, pass, mail, rank, date_inscription) VALUES( ?, ?, ?, "Membre", CURRENT_TIME())');
        $newUser = $req->execute(array( $pseudo, $password, $email ));

        return $newUser;

    }

    public function checkPseudo($pseudo)
    {
        $req = $this->dbConnect()->prepare("SELECT COUNT(pseudo) FROM users WHERE pseudo=?");
        $req->execute(array($pseudo));
        $checkPseudo = $req->fetch();
        return $checkPseudo;
    }

    public function checkUser($pseudo)
    {
        $req = $this->dbConnect()->prepare("SELECT id, pseudo, pass, rank FROM users WHERE pseudo=?");
        $req->execute(array($pseudo));
        $checkUser = $req->fetch(\PDO::FETCH_ASSOC);
        return $checkUser;
    }

}
