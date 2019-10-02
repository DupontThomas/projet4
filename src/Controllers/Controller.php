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

    public function render($view, array $params = [])
    {
        return $this->twig->render($view, $params);
    }
}