<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="recherche.js"></script>
  <title>Page de recherche</title>
</head>
<body>
  <header>
    <div class="logo">
      <h2>Orange Digital Kalanso</h2>
      <img src="Orange_logo.svg.png" alt="Image représentant le logo d'Orange" width="50px" height="50px">
    </div>
    <nav class="menu">
      <ul>
        <ul>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="Enregistrer.html">Enregistrer</a></li>
            <li><a href="Rechercher.html">Rechercher</a></li>
            <li><a href="Modifier.html">Modifier</a></li>
            <li><a href="Supprimer.html">Supprimer</a></li>
            <li><a href="list.php">Liste</a></li>
        </ul>
      </ul>
    </nav>
  </header>
  <h3>Recherche d'apprenant</h3>
  <form action="recherche.php" method="get" accept-charset="utf-8">
    <div class="container">
      <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" placeholder="Saisir le nom de l'apprenant" required>
      </div>
      <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" placeholder="Saisir le prénom de l'apprenant" required>
      </div>
      <div>
        <input type="submit" value="Rechercher">
      </div>
    </div>
  </form><br>
  <?php
require_once "config.php";

// Vérification des paramètres de recherche
if (isset($_GET['nom']) && isset($_GET['prenom'])) {
    // Récupération des paramètres de recherche
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];

    try {
        // Requête SQL pour rechercher les apprenants
        $requete = "SELECT * FROM apprenant WHERE nom=:nom AND prenom=:prenom";

        // Préparation de la requête
        $statement = $link->prepare($requete);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);

        // Exécution de la requête
        $statement->execute();

        // Vérification s'il y a des résultats
        if ($statement->rowCount() > 0) {
            // Affichage des données des apprenants
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nom</th>";
            echo "<th>Prénom</th>";
            echo "<th>Âge</th>";
            echo "<th>Promotion</th>";
            echo "<th>Année de certification</th>";
            echo "<th>Téléphone</th>";
            echo "<th>Email</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['prenom'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['promotion'] . "</td>";
                echo "<td>" . $row['anneeCertification'] . "</td>";
                echo "<td>" . $row['telephone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "Aucun apprenant trouvé.";
        }

        // Fermeture du statement
        $statement = null;
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }

    // Fermeture de la connexion à la base de données
    $link = null;
} else {
    echo "Veuillez spécifier les paramètres de recherche (nom, prénom, âge).";
}
?>

    <footer>
    </footer>
</body>
</html>

