<?php

function dbConnect() {
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

function getPosts() {

    $db = dbConnect();
    $listPosts = $db -> prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS date_post  FROM posts ORDER BY id DESC");
    $listPosts->execute();
    return $listPosts;
}

function getPost($id_post) {
    $db = dbConnect();
    $req = $db -> prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS date_post  FROM posts WHERE id_post=? ");
    $req->execute(array('id_post'));
    $postbase = $req->fetchAll();
    var_dump($postbase);
    return $postbase;
}

function getComments($id_post) {
    $db = dbConnect();
    $comments = $db -> prepare("SELECT id, id_post, author, comment, DATE_FORMAT(date_publication, '%d/%m/%Y à %Hh%imin%ss') AS date_comment FROM comments WHERE id_post=? ORDER BY id");
    $comments->execute(array('id_post'));
    return $comments;
}

