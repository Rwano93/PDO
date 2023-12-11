<?php
$bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $metier = $_POST["metier"];
    $pays = $_POST["Pays"];
    $email = $_POST["mail"];
    $password = $_POST["password"];

    // Vérifier si l'utilisateur existe déjà
    $verification = $bdd->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $verification->execute([$email]);
    $count = $verification->fetchColumn();

    if ($count > 0) {
        echo "Cet utilisateur existe déjà. Veuillez choisir un autre email.";
    } else { // Sinon, inscription.
        $requete = $bdd->prepare("INSERT INTO user (nom, prenom, age, metier, Pays, email, mdp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $requete->execute([$nom, $prenom, $age, $metier, $pays, $email, $password]);

        $result = $requete->rowCount();
        if ($result > 0) {
            echo "Inscription réussie!";
        } else {
            echo "Erreur lors de l'inscription";
        }
    }
}
?>
