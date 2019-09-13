<?php

function getPosts() {

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    $posts = $db -> query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS day_post, DATE_FORMAT(creation_date, '%Hh%imin%ss') AS hour_post  FROM posts ORDER BY id DESC");

    return $posts;

}