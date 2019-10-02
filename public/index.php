<?php
session_start();
use App\Controllers\Router;

require_once '../vendor/autoload.php';

use Tracy\Debugger;
Debugger::enable();

$router = new Router();
$router->run();
