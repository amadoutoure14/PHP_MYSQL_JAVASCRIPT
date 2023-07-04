<!DOCTYPE html>
<html>
<head>
    <title>Liste des apprenants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Liste des apprenants</h1>

    <?php
    require_once "config.php";

    function retrieveApprenants() {
        global $link;

        // Requête SQL pour récupérer tous les apprenants
        $requete = "SELECT * FROM apprenant";
        $resultat = $link->query($requete);

        if ($resultat->rowCount() > 0) {
            echo '<table>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Age</th>
                        <th>Date de naissance</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>';

            while ($row = $resultat->fetch()) {
                echo '<tr>
                        <td>' . $row["matricule"] . '</td>
                        <td>' . $row["nom"] . '</td>
                        <td>' . $row["prenom"] . '</td>
                        <td>' . $row["age"] . '</td>
                        <td>' . $row["dateNaissance"] . '</td>
                        <td>' . $row["email"] . '</td>
                        <td>' . $row["telephone"] . '</td>
                        <td>
                            <a href="modifier.html">Modifier</a>
                            <a href="supprimer.html">Supprimer</a>
                        </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo "Aucun apprenant trouvé.";
        }
    }

    retrieveApprenants();

    // Fermeture de la connexion à la base de données
    $link = null;
    ?>

</body>
</html>
