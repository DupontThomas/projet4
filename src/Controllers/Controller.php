<?php
namespace App\Controllers;


class Controller {

function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../src/views');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
    }
}


