<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\UserManager;
use Twig\Environment;

class UserController extends Controller
{

    private $userManager = null;
    private $commentManager = null;

    public function __construct(Environment $twig)
    {
        parent::__construct($twig);

        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
    }

    public function inscription()
    {
        $this->display('inscription.twig');
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
                header("Location: http://localhost/projet4/public/index.php");
                exit;
            } else {
                $this->alert("Ce pseudo est déjà utilisé. Veuillez en choisir un autre");
                $this->display("inscription.twig");
            }
        } else {
            $this->alert("Les mots de passe ne sont pas identiques. Veuillez vérifier votre saisie.");
            $this->display("inscription.twig");
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
                header("Location: http://localhost/projet4/public/index.php");
                exit;
            } else {
                $this->alert("Identifiant ou mot de passe incorrect !");
                $this->display('inscription.twig');
            }
        } else {
            $this->alert("Identifiant ou mot de passe incorrect !");
           $this->display('inscription.twig');
        }
    }

    public function deconnection()
    {
        session_destroy();
        header("Location: http://localhost/projet4/public/index.php");
        exit;
    }

    public function displayAdmin()
    {
        $listReportedComment = $this->commentManager->reportedComment();
        $this->display('administration.twig', ['contents' => $listReportedComment]);
    }
}

