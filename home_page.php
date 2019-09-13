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
