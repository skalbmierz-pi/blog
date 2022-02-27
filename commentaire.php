<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>BLOG</title>
    <link rel="stylesheet" type="text/css" href="commentaire.css" /> 
    </head>
        
    <body>
        <h1>COMMENTAIRES</h1>
		<center>
        <p><a href="blog.php">Retour à la liste des avis</a></p>
		</center>
		
		<center>
        <p><strong>Nouvelle réponse :</strong></p>
        <form method="post" action="commentaire_post.php?billet=<?php echo $_GET['billet'];?>"> 
		
            <label for="auteur">Auteur : </label><input type="text" name="auteur" placeholder="Entrez nom ou pseudo..." maxlength="50" required/><br />
            <label for="commentaire">Réponse : </label><br /><textarea name="commentaire" rows="5" cols="45" placeholder="Ecrivez votre réponse ici..." required></textarea><br />
			
			 
            <input type="submit" value="Envoyer" />
        </form>
            	Actualiser la page pour visualiser
		</center>
		<br/>
				
 
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


// Récupération du billet
$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');


$req->execute(array($_GET['billet']));


$donnees = $req->fetch();


?>

<div class="news">
    <h2>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h2>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    </p>
</div>

 

<?php
$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

// Récupération des commentaires
$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire,\'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');

$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch())
{
?>
<p><strong>Réponses :</strong></p>
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
} // Fin de la boucle des commentaires 
$req->closeCursor();
		
?>
</br>

		
</body>
</html>