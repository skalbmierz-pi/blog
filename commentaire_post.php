<!DOCTYPE html>
<html>
<body>
   <head>
   <meta charset="utf-8"/>
   <title>BLOG</title>
   <link rel="stylesheet" type="text/css" href="commentaire.css"/>
   </head>
   
<?php

    try
{
    $bdd = new PDO('mysql:host=localhost;dbname=ddb;charset=utf8', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
    $req = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())') or die(print_r($bdd -> getMessage()));
    $req->execute(array(
                         ':id_billet' => htmlspecialchars($_GET['billet']),
                         ':auteur' => htmlspecialchars($_POST['auteur']),
                         ':commentaire' => htmlspecialchars($_POST['commentaire'])
                         ));
						 
if(!empty($req))
                                             
{
$message='le commentaire a bien été ajouté à la bdd';
}
else{
$message='echec de l\'insertion';
}

?>
          <p>
		      Messages : <span id="messages"><?=$message?></span>
			  <br/>
			  <br/>
	          <a href="blog.php">Retour à la liste des avis</a> 
		  </p>

						 
		  
</body>		  
</html>