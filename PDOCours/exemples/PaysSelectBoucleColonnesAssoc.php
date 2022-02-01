<?php

/*

 */
header("Content-Type: text/html; charset=UTF-8");

$message = "";
$tableHTML = "";

try {
    // --- Tentative de connexion
    $connexion = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    // --- Attributs de connexion : erreur --> exception
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // --- Communication UTF-8 entre BD et script
    $connexion->exec("SET NAMES 'UTF8'");

    $curseur = $connexion->query("SELECT * FROM pays");
    //$curseur->setFetchMode(PDO::FETCH_ASSOC);

    // On boucle sur les lignes du curseur
    foreach ($curseur as $enregistrement) {
        $tableHTML .= "<tr>";
        // On boucle sur les colonnes de l'enregistrement courant
        foreach ($enregistrement as $valeur) {
            $tableHTML .= "<td>$valeur</td>";
        }
        $tableHTML .= "</tr>";
    }

    $curseur->closeCursor();
} /// try
// --- Récupération d'une exception
catch (PDOException $e) {
    $message = "Echec de l'exécution : " . $e->getMessage();
} /// catch
// --- Deconnexion
$connexion = null;

?>


<table border="1">
    <thead>
    </thead>
    <tbody>
        <?php
        echo $tableHTML;
        ?>
    </tbody>
</table>

<label>
    <?php
        echo $message;
        ?>
    </label>