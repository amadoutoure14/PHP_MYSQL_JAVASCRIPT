<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs des champs du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prénom"];
    $dateNaissance = $_POST["dateNaissance"];
    $age = $_POST["âge"];
    $photo = $_FILES["photo"]["tmp_name"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $promotion = $_POST["promotion"];
    $annee = $_POST["annee"];

    // Fonction pour générer le matricule
    function genererMatricule($annee) {
        $prefixe = "P" . substr($annee, -1); // Récupère le dernier chiffre de l'année
        $suffixe = genererChaineAleatoire(4); // Génère une chaîne de 4 caractères aléatoires (mélange de chiffres et de lettres)

        return $prefixe . $suffixe;
    }

    // Fonction pour générer une chaîne aléatoire
    function genererChaineAleatoire($longueur) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chaineAleatoire = '';

        for ($i = 0; $i < $longueur; $i++) {
            $chaineAleatoire .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        return $chaineAleatoire;
    }

    // Génération du matricule
    $matricule = genererMatricule($annee);

    // Vérification des champs obligatoires
    if (!empty($nom) && !empty($prenom) && !empty($dateNaissance) && !empty($age) && !empty($photo) && !empty($tel) && !empty($email) && !empty($promotion) && !empty($annee)) {
        try {
            // Lecture du contenu de l'image
            $contenuPhoto = file_get_contents($photo);

            // Requête SQL pour ajouter l'apprenant à la base de données
            $requete = "INSERT INTO apprenant (matricule, nom, prenom, age, dateNaissance, email, telephone, photo, promotion, anneeCertification) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Préparation de la requête
            $statement = $link->prepare($requete);

            // Exécution de la requête
            $statement->execute([$matricule, $nom, $prenom, $age, $dateNaissance, $email, $tel, $contenuPhoto, $promotion, $annee]);

            // Vérification du succès de l'insertion
            if ($statement->rowCount() > 0) {
                echo "Apprenant ajouté avec succès !";
                header("location:list.php");
                exit();
            } else {
                echo "Erreur lors de l'ajout de l'apprenant.";
                header("location:enregistrer.html");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }

        // Fermeture du statement
        $statement = null;

        // Fermeture de la connexion à la base de données
        $link = null;
    } else {
        echo "Veuillez remplir tous les champs obligatoires.";
    }
}
?>
