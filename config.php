<?php
/* Informations de connexion à la base de données */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "odk";

try {
    /* Connexion à la base de données avec PDO */
    $link = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    /* Configuration des options PDO */
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
