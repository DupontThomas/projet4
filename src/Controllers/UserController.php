<?php
namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\UserManager;

class UserController extends Controller
{

    /**
     * @var \App\Models\UserManager
     * @var \App\Models\CommentManager
     */
    private $userManager;
    private $commentManager;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();

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
                $this->refresh("index.php");
                exit;
            }
                $this->alert("Ce pseudo est déjà utilisé. Veuillez en choisir un autre");
                $this->display("inscription.twig");
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
                $this->refresh("index.php");
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
        $this->refresh("?page=home");
        exit;
    }

    public function displayAdmin()
    {
        $listReportedComment = $this->commentManager->reportedComment();
        $listUser = $this->userManager->listUser();
        $this->display('administration.twig', ['comments' => $listReportedComment, 'users' => $listUser]);
    }

    /**
     * @param $id_user
     */
    public function delUser($id_user)
    {
        $this->userManager->delUser($id_user);
        $this->refresh("?page=admin");
    }
}

