<?php

/*
 * TableBD2JsonFile.php
 */

try {

    $lcn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcn->exec("SET NAMES 'UTF8'");

    $lrs = $lcn->query("SELECT * FROM pays ORDER BY id_pays");
    $lrs->setFetchMode(PDO::FETCH_ASSOC);

    $tPays = $lrs->fetchAll();

    $lrs->closeCursor();

    $chaineJSON = json_encode($tPays);

    file_put_contents("../ressources/pays_from_bd.json", $chaineJSON);
} catch (PDOException $e) {
    $lsPays = "Echec de l'exécution : " . $e->getMessage();
}

$lcn = null;

//  Re-lecture
echo "<hr>Re-lecture pour contrôle<hr>";

// Récupération du contenu du fichier sous forme de flux de caractères
$contenuFichier = file_get_contents("../ressources/pays_from_bd.json");

$jsonObjet = json_decode($contenuFichier);

// Boucle sur les éléments du tableau
for ($i = 0; $i < count($jsonObjet); $i++) {
    // Affichage des valeurs des attributs de chaque élément
    echo $jsonObjet[$i]->id_pays . " : " . $jsonObjet[$i]->nom_pays . "<br>";
}
?>