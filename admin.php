<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélection et Suppression d'Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
    <h1>Sélection et Suppression d'Utilisateur</h1>
 
    <form action="traitement_utilisateur.php" method="post">
        <label for="utilisateur">Choisissez un utilisateur :</label>
        <select id="utilisateur" name="utilisateur">
            <?php
            session_start();
            $bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');
            $requete = "SELECT id_user, nom, email, mdp  FROM user"; 
            
            $resultat = $bdd->query($requete);
 
            foreach ($resultat as $utilisateur) {
                echo "<option value='" . $utilisateur['id_user'] . "'>" . "ID: " . $utilisateur['id_user'] . " - " . $utilisateur['nom'] . " - Email: " . $utilisateur['email'] ." - Mot de passe: " . $utilisateur['mdp'] ."</option>";
            }
            ?>
        </select>
        <input type="submit" value="Supprimer l'utilisateur" name="supprimer">
        
    </form>
    <form action="modification_utilisateur.php" method="post">
        <label for="utilisateur">Choisissez un utilisateur :</label>
        <select id="utilisateur" name="utilisateur">
            <?php
            session_start();
            $bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');
            $requete = "SELECT id_user, nom, email, mdp  FROM user"; 
            
            $resultat = $bdd->query($requete);

            foreach ($resultat as $utilisateur) {
                echo "<option value='" . $utilisateur['id_user'] . "'>" . "ID: " . $utilisateur['id_user'] . " - " . $utilisateur['nom'] . " - Email: " . $utilisateur['email'] ." - Mot de passe: " . $utilisateur['mdp'] ."</option>";
            }
            ?>
        </select>
        <input type="submit" value="Modifier l'utilisateur" name="modifier">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['supprimer'])) {
            $idUtilisateurASupprimer = $_POST['utilisateur'];


            $bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');
            $requeteSuppression = "DELETE FROM user WHERE id_user = ?";
            $statement = $bdd->prepare($requeteSuppression);
            $statement->execute([$idUtilisateurASupprimer]);

            echo "<p>L'utilisateur avec l'ID $idUtilisateurASupprimer a été supprimé avec succès.</p>";
        }elseif (isset($_POST['modifier'])) {
        $idUtilisateurAModifier = $_POST['utilisateur'];


        $requeteModification = "SELECT * FROM user WHERE id_user = ?";
        $statementModification = $bdd->prepare($requeteModification);
        $statementModification->execute([$idUtilisateurAModifier]);
        $utilisateurAModifier = $statementModification->fetch();
        }

        ?>
        <h2>Modification de l'utilisateur</h2>
        <style>
            h2{
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 30px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

        </style>
        <form action="modification_utilisateur.php" method="post">
            <h2>MODIF</h2>
            <input type="hidden" name="id_utilisateur_modif" value="<?php echo $idUtilisateurAModifier; ?>">
            <label for="nom_modif">Nouveau Nom :</label>
            <input type="text" id="nom_modif" name="nom_modif" value="<?php echo $utilisateurAModifier['nom']; ?>" required>
            <br>
            <label for="prenom_modif">Nouveau Prénom :</label>
            <input type="text" id="prenom_modif" name="prenom_modif" value="<?php echo $utilisateurAModifier['prenom']; ?>" required>
            <br>
            <label for="age_modif">Nouvel Age :</label>
            <input type="text" id="age_modif" name="age_modif" value="<?php echo $utilisateurAModifier['age']; ?>" required>
            <br>
            <label for="metier_modif">Nouveau Métier :</label>
            <input type="text" id="metier_modif" name="metier_modif" value="<?php echo $utilisateurAModifier['metier']; ?>" required>
            <br>
            <label for="pays_modif">Nouveau Pays :</label>
            <input type="text" id="pays_modif" name="pays_modif" value="<?php echo $utilisateurAModifier['pays']; ?>" required>
            <br>
            <label for="email_modif">Nouvel Email :</label>
            <input type="text" id="email_modif" name="email_modif" value="<?php echo $utilisateurAModifier['email']; ?>" required>
            <br>
            <label for="mdp_modif">Nouveau Mot de Passe :</label>
            <input type="text" id="mdp_modif" name="mdp_modif" value="<?php echo $utilisateurAModifier['mdp']; ?>" required>
            <br>
            
            <input type="submit" value="Valider la modification" name="valider_modification">
            
        </form>
        <?php
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['valider_modification'])) {
            $idUtilisateurModifie = $_POST['id_utilisateur_modif'];
            $nouveauNom = $_POST['nom_modif'];
            $nouveauPrenom = $_POST['prenom_modif'];
            $nouveauAge = $_POST['age_modif'];
            $nouveauMetier = $_POST['metier_modif'];
            $nouveauPays = $_POST['pays_modif'];
            $nouveauEmail = $_POST['email_modif'];
            $nouveauMdp = $_POST['mdp_modif'];

            $requeteUpdate = "UPDATE user SET nom = ?, prenom = ?, age = ?, metier = ?, Pays = ?, email = ?, mdp = ? WHERE id_user = ?";
            $statementUpdate = $bdd->prepare($requeteUpdate);
            $statementUpdate->execute([$nouveauNom, $nouveauPrenom, $nouveauAge, $nouveauMetier, $nouveauPays, $nouveauEmail, $nouveauMdp, $idUtilisateurModifie]);

            echo "<p>L'utilisateur avec l'ID $idUtilisateurModifie a été modifié avec succès.</p>";
        }
    }
?>
<style>
    .bouton {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px; 
        
    }

    .bouton input {
        margin: 0 10px; 
    }
</style>

<div class="bouton">
    <input type="button" value="Retour" onclick="window.location.href='admin.php'" />
    <input type="button" value="Déconnexion" onclick="window.location.href='enregistrer.html'" />
</div>

</body>
</html>
