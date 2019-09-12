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
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$billets = $bdd -> query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y') AS jour, DATE_FORMAT(date_creation, '%Hh%imin%ss') AS heure  FROM billets ORDER BY id DESC");

while ($billet = $billets->fetch()) {
    ?>

    <div class="news">
        <h3><?php echo $billet['titre'] . " Publié le " . $billet['jour'] . " à " . $billet['heure']; ?>  </h3>
        <p><?php echo $billet['contenu']; ?></p>
        <a href=<?php echo "commentaires.php?id=" . $billet['id'];?>>Commentaires</a>
    </div>

<?php
    };

$billets->closeCursor(); // Termine le traitement de la requête
?>


</body>
</html>


