<?php

// --- UserSelectWithIniFile.php
header("Content-Type: text/html; charset=UTF-8");

try {
    // Connexion
    // Récupération du contenu du fichier cours.ini dans un tableau associatif
    $tProprietes = parse_ini_file("../conf/cours_OVH.ini");

    // Récupération une à une des valeurs des clés du tableau associatif
    $host = $tProprietes["serveur"];
    $db = $tProprietes["bd"];
    $user = $tProprietes["ut"];
    $pwd = $tProprietes["mdp"];

    // Utilisation des variables dans le DSN et les autres paramètres
    $connexion = new PDO("mysql:host=$host;port=3306;dbname=$db;", $user, $pwd);

    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->exec("SET NAMES 'UTF8'");

    // Préparation et exécution du SELECT SQL
    $select = "SELECT * FROM user";
    $curseur = $connexion->query($select);
    $curseur->setFetchMode(PDO::FETCH_NUM);

    $lsContenu = "";

    // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
    foreach ($curseur as $enregistrement) {
        // Récupération des valeurs par concaténation et interpolation
        $lsContenu .= "$enregistrement[0]-$enregistrement[3]<br>";
    }
    // Fermeture du curseur (facultatif)
    $curseur->closeCursor();
}
// Gestion des erreurs
catch (PDOException $e) {
    $lsContenu = "Echec de l'exécution : " . $e->getMessage();
}

// Déconnexion (facultative)
$connexion = null;

// Affichage du contenu
echo $lsContenu;
?>