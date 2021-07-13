<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
            $reponse = $bdd->prepare('SELECT * FROM `billets` WHERE id = ?');
            $reponse->execute(array($_GET['id']));

    /* RECUPERER ARTICLE */

            while ($donnees = $reponse->fetch()){
            ?> 
                <div class="contenu">  
                    <h3><?php echo htmlspecialchars($donnees['titre']); ?> le <?php echo $donnees['date_creation']; ?></h3>
                    <div class="text">
                        <p><?php echo htmlspecialchars($donnees['contenu']); ?></p>
                    </div>
                </div>  
                    <?php
                }
            
            $reponse->closeCursor();

/* RECHERCHE DES COMMENTAIRES */

            $reponse = $bdd->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM `commentaires` WHERE id_billet = ?');
            $reponse->execute(array($_GET['id']));
            while ($donnees = $reponse->fetch()){
            ?>
                <div class="contenu">
                    <h4 id="titre_commentaire">
                    <?php  echo htmlspecialchars($donnees['auteur']); ?> le  <?php echo $donnees['date_creation_fr']; ?><a href="commentaires.php?id=<?php echo $donnees['id_billet']?>&delete=<?php echo $donnees['id']?>" id="cross">X</a> </h4>
                    <p><?php echo htmlspecialchars($donnees['commentaire']); ?></p>
                    
                    </div>
                    <?php
                    }
                    $reponse->closeCursor();
/* SUPPRIMER COMMENTAIRE */
            if (isset($_GET['delete'])){
                $resp = $bdd->prepare('DELETE FROM `commentaires` WHERE id=?');
                $resp->execute(array($_GET['delete']));
                header('Location: commentaires.php?id='. $_GET['id']); 
                $resp->closeCursor();
                    }
                    
                    ?>
<!-- REDIGER COMMENTAIRE -->
    <form action="commentaires_post.php?id_billet=<?php echo $_GET['id']?>" method="POST">
        <fieldset>
            <legend>Your Comment</legend>
        
            <label>Your Pseudo</label>
            <input type="text" name="pseudo">
            <label>Comment</label>
            <input type="text" name="comment">
            <input type="submit" name="submit">
        </fieldset>
    </form>





        <a href="index.php" class="retour">Retour aux articles</a>
    </div>
</body>
</html>