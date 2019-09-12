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
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$nbBillet = $_GET['id'];

$articles = $bdd -> query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y') AS jourb, DATE_FORMAT(date_creation, '%Hh%imin%ss') AS heureb  FROM billets WHERE id=$nbBillet ");

$commentaires = $bdd -> query("SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y') AS jourc, DATE_FORMAT(date_commentaire, '%Hh%imin%ss') AS heurec FROM commentaires WHERE id_billet=$nbBillet ORDER BY id");

while ($article = $articles->fetch()) {
    ?>

    <div class="news">
        <h3><?php echo $article['titre'] . " Publié le " . $article['jourb'] . " à " . $article['heureb']; ?>  </h3>
        <p><?php echo $article['contenu']; ?></p>
    </div>
    <?php
};
$articles->closeCursor(); // Termine le traitement de la requête
?>

    <h4>Commentaires :</h4>

<?php
while ($commentaire = $commentaires->fetch()) {
  ?>

    <p><strong><?php echo $commentaire['auteur']?></strong><?php echo " Publié le " . $commentaire['jourc'] . " à " . $commentaire['heurec'];?> </p>
    <p><?php echo $commentaire['commentaire'];?> </p>
<?php
}

$commentaires->closeCursor(); // Termine le traitement de la requête
?>



</body>
</html>