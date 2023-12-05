<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Préparation et exécution de la requête SQL
    $requete = $bdd->prepare("SELECT id_user, nom, prenom, metier, Pays, email, mdp FROM user WHERE email = ?");
    $requete->execute([$email]);

    if ($requete->errorInfo()[0] !== '00000') {
        die("Erreur SQL : " . $requete->errorInfo()[2]);
    }

    $utilisateur = $requete->fetch();
    if ($utilisateur && password_verify($password, $utilisateur['mdp'])) {

        $_SESSION['email'] = $email;
        echo "Connexion réussie"; 
        exit();
    } else {
        echo "Email ou mot de passe incorrect";
    }
}
?>
