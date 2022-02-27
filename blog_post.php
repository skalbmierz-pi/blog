<!DOCTYPE html>
<html>
<body>
   <head>
   <meta charset="utf-8"/>
   <link rel="stylesheet" type="text/css" href="blog.css"/>
   <title>BLOG</title>
   </head>
   
   <body>


<?php

//ouverture d'une connexion à la bdd blog
$objetPdo = new PDO ('mysql:host=localhost;dbname=ddb','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//preparation de l'insertion (SQL)
$pdoStat = $objetPdo->prepare('INSERT INTO billets VALUE(NULL,:titre,:contenu,NOW())');

//lien de chaque marqueur à une valeur
$pdoStat->bindValue(':titre',$_POST['titre'],PDO::PARAM_STR);
 
//lien de chaque marqueur à une valeur
$pdoStat->bindValue(':contenu',$_POST['contenu'],PDO::PARAM_STR);
 

//exécution de la requète préparée
$insertIsOk=$pdoStat->execute();

if($insertIsOk)
{
$message='le message a bien été ajouté à la bdd';
}
else{
$message='echec de l\'insertion';
}

?>


          <p>
		      Messages : <span id="messages"><?=$message?></span>
			  <br/>
			  <br/>
              <a href="blog.php">Retour à la liste d'avis du blog</a>
		  </p>
		  
	</body>
</html>