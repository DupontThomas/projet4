<?php
session_start();

require_once '../vendor/autoload.php';

use Tracy\Debugger;
Debugger::enable();

//require('../config/DbConnection.php');
require('../src/controllers/Test.php');
//require('../src/models/CommentManager.php');