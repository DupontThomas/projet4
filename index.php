<?php
use Tracy\Debugger;

Debugger::enable();

require('src/model/model.php');

$listPosts = getPosts();

require('src/view/home_page.php');