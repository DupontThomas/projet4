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

    public function alert($message) {
        $alert = "<script>alert('$message');</script>";
        echo filter_var($alert);
    }

    public function redirect($url)
    {
        $redirect = "<script>window.location = '$url'</script>";
        echo filter_var($redirect);
    }
}