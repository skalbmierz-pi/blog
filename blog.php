<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>BLOG</title>
	<link rel="stylesheet" type="text/css" href="blog.css"  /> 
    </head>
        
<body>
        <center>
        <h1>BLOG</h1>
		<a href="">Retour à la page d'acceuil</a>
		<br/>
		<br/>

		<center>
		<p><strong>Enregistrez votre avis :</strong></p>
		<form method="post" action="blog_post.php">
				   
            <label for="titre">Titre : </label><input type="text" name="titre"  placeholder="Entrez le titre..." maxlength="50" required/><br />
            <label for="contenu">Avis : </label><br /><textarea name="contenu" rows="5" cols="45" placeholder="Ecrivez votre avis ici..." required></textarea><br />
			<label for="date_creation">Date : </label><input type="text" name="date_creation" placeholder="Entrer la date..." maxlength="50" required/>
            <input type="submit" value="Envoyer" />
        </form>
            	Actualiser la page pour visualiser
        </center>
        </br>
		<br/>
        <p><strong>Derniers avis :</strong></p>
		</center>
 
<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=ddb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 1000');

while ($donnees = $req->fetch())
{
?>

<div class="news">
    
    <h2>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h2>

    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    <br />
    <em><a href="commentaire.php?billet=<?php echo $donnees['id']; ?>">Réponses</a></em>
    </p>

</div>

<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>

   </body>
</html>