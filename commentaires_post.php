<?php

try{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
catch (PDOException $e){
    die('Erreur : ' . $e->getMessage());
    }


if (isset ($_POST['pseudo']) AND isset($_POST['comment'])){

$pseudo = $_POST['pseudo'];
$comment = $_POST['comment'];
$id = $_GET['id_billet'];
$request = $bdd->prepare('INSERT INTO commentaires(auteur, commentaire, id_billet) VALUES (:auteur, :commentaire, :id_billet)');
$request->execute(array(
    'auteur' => $pseudo,
    'commentaire' => $comment,
    'id_billet'=> $id,
    ));
}
$request->closeCursor();

 
header('Location: commentaires.php?id='.$id); 

?>