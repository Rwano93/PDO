<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=erwan_site;charset=utf8', 'root', '');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['supprimer'])) {
        
        $idUtilisateurASupprimer = $_POST['utilisateur'];
        $requeteSuppression = "DELETE FROM user WHERE id_user = ?";
        $statement = $bdd->prepare($requeteSuppression);
        $statement->execute([$idUtilisateurASupprimer]);

        echo "<p>L'utilisateur avec l'ID $idUtilisateurASupprimer a été supprimé avec succès.</p>";
    }

}elseif (isset($_POST['modifier'])) {
    $idUtilisateurAModifier = $_POST['utilisateur'];


    $requeteModification = "SELECT * FROM user WHERE id_user = ?";
    $statementModification = $bdd->prepare($requeteModification);
    $statementModification->execute([$idUtilisateurAModifier]);
    $utilisateurAModifier = $statementModification->fetch();
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

