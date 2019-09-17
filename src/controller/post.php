<?php
require('../model/model.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    getPost($_GET['id']);
    getComments($_GET['id']);
    require('../view/post_view.php');
}
else {
echo 'erreur : aucun identifiant de billet envoyé';
}