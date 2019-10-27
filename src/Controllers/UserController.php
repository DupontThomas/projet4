<?php
namespace App\Controllers;

use App\Models\UserManager;
use Twig\Environment;

class UserController extends Controller
{

    private $userManager = null;

    public function __construct(Environment $twig)
    {
        parent::__construct($twig);

        $this->userManager = new UserManager();
    }

    function display()
    {
        echo $this->render('inscription.twig');
    }

    function addUser()
    {
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $mail = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $passwordCheck = filter_input(INPUT_POST, 'password2');

        if ($password === $passwordCheck) {
            $this->userManager->checkPseudo($pseudo);

            if ($checkPseudo[0] > 0) {
                $cryptedPass = password_hash($password, PASSWORD_DEFAULT);
                $this->userManager->addUser($pseudo, $mail, $cryptedPass);
            } else {
                $this->alert("Ce pseudo est déjà utilisé. Veuillez en choisir un autre");
            }
        }
        else {
                $this->alert("Les mots de passe ne sont pas identiques. Veuillez vérifier votre saisie.");
        }
    }
}




