<?php
require_once "config.php";

// Fonction pour mettre à jour les informations de l'apprenant
function mettreAJourApprenant($link, $matricule, $nom, $prenom, $age, $telephone, $email, $promotion, $anneeCertification) {
    $requete = "UPDATE apprenant SET nom = ?, prenom = ?, age = ?, telephone = ?, email = ?, promotion = ?, anneeCertification = ? WHERE matricule = ?";
    $statement = $link->prepare($requete);
    if ($statement->execute([$nom, $prenom, $age, $telephone, $email, $promotion, $anneeCertification, $matricule])) {
        return true;
    } else {
        return false;
    }
}

// Vérifier si la requête est de type POST (soumission du formulaire)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $matricule = $_POST["matricule"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prénom"];
    $age = $_POST["âge"];
    $telephone = $_POST["tel"];
    $email = $_POST["email"];
    $promotion = $_POST["promotion"];
    $anneeCertification = $_POST["annee"];

    // Mettre à jour les informations de l'apprenant
    if (mettreAJourApprenant($link, $matricule, $nom, $prenom, $age, $telephone, $email, $promotion, $anneeCertification)) {
        // Rediriger vers la page de confirmation
        header("Location: list.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'apprenant.";
    }
}

// Récupérer le matricule de l'URL
$matricule = $_GET["matricule"];

// Récupérer les informations de l'apprenant
$requete = "SELECT * FROM apprenant WHERE matricule = ?";
$statement = $link->prepare($requete);
$statement->execute([$matricule]);
$apprenant = $statement->fetch();

// Fermeture du statement
$statement = null;

// Fermeture de la connexion à la base de données
$link = null;
?>