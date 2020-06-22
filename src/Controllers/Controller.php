<?php
namespace App\Controllers;

use App\Configuration;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader( '../src/Views');
        $twig = new Environment($loader, [
            'cache' => false,
            //'debug' => false
        ]);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('url', new Configuration());

        $this->twig = $twig;
    }

    public function display($view, array $params = [])
    {
        return $this->twig->display($view, $params);
    }

    public function alert($message) {
        $this->twig->addGlobal("alertMessage", $message);
    }
}