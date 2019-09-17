<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Page d'accueil de mon blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Mon super blog !</h1>

<a href="../../index.php">Retour à la liste des billets</a>

    <div class="news">
        <h3><?php echo $postbase['title'] . " Publié le " . $postbase['date_post']; ?>  </h3>
        <p><?php echo $postbase['content']; ?></p>
    </div>


    <h4>Commentaires :</h4>

<?php
while ($comment = $comments->fetch()) {
  ?>

    <p><strong><?php echo htmlspecialchars($comment['author'])?></strong><?php echo " Publié le " . $comment['date_comment'];?> </p>
    <p><?php echo htmlspecialchars($comment['comment']);?> </p>
<?php
}

$comments->closeCursor(); // Termine le traitement de la requête
?>



</body>
</html>