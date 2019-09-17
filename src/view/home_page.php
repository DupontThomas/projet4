<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Page d'accueil de mon blog</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<h1>Mon super blog !</h1>

<h2>Dernier billets du blog :</h2>

<?php

while ($posts = $listPosts->fetch()) {
    ?>

    <div class="news">
        <h3><?php echo htmlspecialchars($posts['title'] . " Publié le " . $posts['date_post']); ?>  </h3>
        <p><?php echo htmlspecialchars($posts['content']); ?></p>
        <a href=<?php echo "http://localhost/projet4/src/controller/post.php?id=" . $posts['id'];?>>Commentaires</a>
    </div>

    <?php
};

$listPosts->closeCursor(); // Termine le traitement de la requête
?>


</body>
</html>
