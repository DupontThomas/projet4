<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Page d'accueil de mon blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Mon super blog !</h1>

<a href="index.php">Retour à la liste des billets</a>

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

$nbPost = $_GET['id'];

$news = $db -> query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS day_post, DATE_FORMAT(creation_date, '%Hh%imin%ss') AS hour_post  FROM posts WHERE id=$nbPost ");

$comments = $db -> query("SELECT id, id_post, author, comment, DATE_FORMAT(date_publication, '%d/%m/%Y') AS day_comment, DATE_FORMAT(date_publication, '%Hh%imin%ss') AS hour_comment FROM comments WHERE id_post=$nbPost ORDER BY id");

while ($new = $news->fetch()) {
    ?>

    <div class="news">
        <h3><?php echo $new['title'] . " Publié le " . $new['day_post'] . " à " . $new['hour_post']; ?>  </h3>
        <p><?php echo $new['content']; ?></p>
    </div>
    <?php
};
$news->closeCursor(); // Termine le traitement de la requête
?>

    <h4>Commentaires :</h4>

<?php
while ($comment = $comments->fetch()) {
  ?>

    <p><strong><?php echo $comment['author']?></strong><?php echo " Publié le " . $comment['day_comment'] . " à " . $comment['hour_comment'];?> </p>
    <p><?php echo $comment['comment'];?> </p>
<?php
}

$comments->closeCursor(); // Termine le traitement de la requête
?>



</body>
</html>