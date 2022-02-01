<?php

// --- GetColumNamesFromCursor.php
header("Content-Type: text/html; charset=UTF-8");

try {
    $connexion = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->exec("SET NAMES 'UTF8'");

    $curseur = $connexion->query("SELECT * FROM villes");
    $curseur->setFetchMode(PDO::FETCH_ASSOC);

    // Initialisations
    $entetes = "";
    $contenu = "";

    // Extraction du premier enregistrement pour récupérer les noms des colonnes et les valeurs du 1e enregistrement
    $ligne = $curseur->fetch();
    foreach ($ligne as $colonne => $valeur) {
        $entetes .= $colonne . ";";
        $contenu .= $valeur . ";";
    }
    // On enlève le dernier ;
    $entetes = substr($entetes, 0, -1);
    $contenu = substr($contenu, 0, -1);
    $entetes .= "\n";
    $contenu .= "\n";

    // On boucle sur les lignes de la table à partir de la 2ème ligne
    while ($ligne = $curseur->fetch()) {
        // On boucle sur les colonnes, on ne récupère que les valeurs
        foreach ($ligne as $valeur) {
            // On récupère les valeurs des colonnes
            $contenu .= $valeur . ";";
        }
        // On enlève le dernier ;
        $contenu = substr($contenu, 0, -1);
        // On ajoute le séparateur d'enregistrement
        $contenu .= "\n";
    }

    // On place les entêtes avant le contenu
    $contenu = $entetes . $contenu;

    $curseur->closeCursor();

    // Affichage
    echo nl2br($contenu);
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$connexion = null;
?>