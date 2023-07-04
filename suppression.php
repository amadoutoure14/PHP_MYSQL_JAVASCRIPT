<?php
require_once "config.php";

// Vérification des paramètres de suppression
if (isset($_POST['matricule']) && isset($_POST['nom']) && isset($_POST['prenom'])) {
    // Récupération des paramètres de suppression
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Requête SQL pour supprimer l'apprenant
    $requete = "DELETE FROM apprenant WHERE matricule=? AND nom=? AND prenom=?";
    $statement = $link->prepare($requete);
    $statement->execute([$matricule, $nom, $prenom]);

    // Redirection vers la page liste après suppression
    header("Location: list.php");
    exit();
} else {
    echo "Veuillez spécifier les informations d'apprenant à supprimer.";
}

// Fermeture de la connexion à la base de données
$link = null;
?>
