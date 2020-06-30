<?php
namespace App\Controllers;

use App\Configuration;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


/**
 * Class Controller
 * @package App\Controllers
 */
class Controller
{
    /**
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * Controller constructor.
     */
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

    /**
     * @param $view
     * @param array $params
     */
    public function display($view, array $params = [])
    {
        return $this->twig->display($view, $params);
    }

    /**
     * @param $page
     */
    public function refresh($page)
    {
        header("Location:" . $page);
    }


    /**
     * @param $message
     */
    public function alert($message) {
        $this->twig->addGlobal("alertMessage", $message);
    }
}