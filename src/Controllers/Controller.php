<?php
namespace App\Controllers;

use Twig\Environment;


class Controller
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function display($view, array $params = [])
    {
        return $this->twig->display($view, $params);
    }

}