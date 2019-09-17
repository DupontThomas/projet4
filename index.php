<?php
use Tracy\Debugger;

require('src/model/model.php');

$listPosts = getPosts();

require('src/view/home_page.php');