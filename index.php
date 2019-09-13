<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Page d'accueil de mon blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Mon super blog !</h1>

<h2>Dernier billets du blog :</h2>

<?php
// Connexion à la base de données
try
{
    $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$posts = $db -> query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS day_post, DATE_FORMAT(creation_date, '%Hh%imin%ss') AS hour_post  FROM posts ORDER BY id DESC");

while ($post = $posts->fetch()) {
    ?>

    <div class="news">
        <h3><?php echo $post['title'] . " Publié le " . $post['day_post'] . " à " . $post['hour_post']; ?>  </h3>
        <p><?php echo $post['content']; ?></p>
        <a href=<?php echo "commentaires.php?id=" . $post['id'];?>>Commentaires</a>
    </div>

<?php
    };

$posts->closeCursor(); // Termine le traitement de la requête
?>


</body>
</html>


