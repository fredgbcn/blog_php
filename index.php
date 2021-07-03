<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
    <?php 
         try{
            $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
        catch (PDOException $e){
                die('Erreur : ' . $e->getMessage());
            }
            $reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM billets ORDER BY ID DESC LIMIT 0, 5');
        while ($donnees = $reponse->fetch())
            {
            ?>
            <div class="contenu">
                <h3><?php echo $donnees['titre']; ?> le  <?php echo $donnees['date_fr']?></h3>
                <div class="text"><p><?php echo $donnees['contenu']?></p>
                <a href="commentaires.php?id=<?php echo $donnees['id']?>">Commentaires</a></div>
            </div>
            <?php
            }
            $reponse->closeCursor();
            ?>
    </div>
</body>
</html>