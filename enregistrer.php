<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Préparation et exécution de la requête SQL
    $requete = $bdd->prepare("SELECT * FROM user WHERE email = ? AND mdp = ?");
    $requete->execute([$email, $password]);

    $result = $requete->fetch();

    if ($result) {
        $_SESSION['user'] = $result['prenom'];
        $Admin = $result['admin'];

        if ($Admin == 1) {
            echo "Connexion réussie en tant qu'administrateur!";
            header ('Location: admin.php');
        } else {
            echo "Connexion réussie, bienvenue!";
            header ('Location: index.php'); 

        }
        } else {
            echo "Erreur lors de la connexion";
    }
}
?>


