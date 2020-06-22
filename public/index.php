<?php

use App\Controllers\Router;
use Tracy\Debugger;

error_reporting(E_ALL);
ini_set("display_errors",1);

require_once '../vendor/autoload.php';

session_start();

Debugger::enable();

$router = new Router();
$router->run();
