<?php

$bdd = new PDO('mysql:host=localhost;dbname=erwan;charset=utf8', 'root', '');

$reponse = $bdd->query('INSERT INTO `utilisateur`(`nom`, `prenom`, `Age`, `password`) VALUES ("'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$_POST['age'].'","'.$_POST['metier'].'","'.$_POST['password'].'")');
$reponse = $bdd->query('INSERT INTO `utilisateur`(`nom`, `prenom`, `Age`, `password`) VALUES ("'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$_POST['age'].'","'.$_POST['metier'].'","'.$_POST['password'].'")');

$donnee = $reponse->fetch();


var_dump($donnee);


?>