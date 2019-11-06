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

    public function display()
    {
        echo $this->render('inscription.twig');
    }

    public function addUser()
    {
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $mail = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $passwordCheck = filter_input(INPUT_POST, 'password2');

        if ($password === $passwordCheck) {
            $checkPseudo = $this->userManager->checkPseudo($pseudo);
            if ($checkPseudo[0] === "0") {
                $cryptedPass = password_hash($password, PASSWORD_DEFAULT);
                $this->userManager->addUser($pseudo, $mail, $cryptedPass);
                $this->redirect('../public/index.php');
            } else {
                $this->alert("Ce pseudo est déjà utilisé. Veuillez en choisir un autre");
                echo $this->render("inscription.twig");
            }
        } else {
            $this->alert("Les mots de passe ne sont pas identiques. Veuillez vérifier votre saisie.");
            echo $this->render("inscription.twig");
        }
    }

    public function connection()
    {
        $pseudo = filter_input(INPUT_POST, 'pseudoConnection');

        $user = $this->userManager->checkUser($pseudo);

        $passwordOk = password_verify(filter_input(INPUT_POST, 'passwordConnection'), $user['pass']);

        if($user) {
            if ($passwordOk) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['rank'] = $user['rank'];
                $this->redirect('../public/index.php');
            } else {
                $this->alert("Identifiant ou mot de passe incorrect !");
                echo $this->render('inscription.twig');
            }
        } else {
            $this->alert("Identifiant ou mot de passe incorrect !");
            echo $this->render('inscription.twig');
        }
    }

    public function deconnection()
    {
        session_destroy();
        $this->redirect('../public/index.php');
    }

    public function displayAdmin()
    {
        echo $this->render('administration.twig');

    }
}




