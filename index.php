<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


    $requete = $bdd->prepare("SELECT * FROM user WHERE email = ? AND mdp = ?");
    $requete->execute([$email, $password]);

    $result = $requete->fetch();

    if ($result) {
       
        $_SESSION['user'] = $result;
        
        echo "Connexion réussie, bienvenue!";
        header("Location: index.html");

        exit();
    } else {
        echo "Erreur lors de la connexion";
    }
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  type="text/css" rel="stylesheet" href="style.css">
    <title>Page d'Index</title>
</head>
<body>
    <h1>Bienvenue sur la page d'index</h1>
    
    <p>Informations de l'utilisateur :</p>
    <ul>
        <li>Nom: <?php echo $user['Nom']; ?></li>
        <li>Prénom: <?php echo $user['Prenom']; ?></li>
        <li>Métier: <?php echo $user['metier']; ?></li>
        <li>Pays: <?php echo $user['Pays']; ?></li>
        <li>Email: <?php echo $user['email']; ?></li>
        <li>Mot de passe: <?php echo $user['mdp']; ?></li>

    </ul>
    <p>Vous souhaitez quitter ?</p>
    <input type="button" value="Déconnexion" onclick="window.location.href='enregistrer.html'" />


</body>
</html>

<?php
}else{
    echo "Vous n'êtes pas connecté.";
}
?>
