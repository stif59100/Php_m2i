<?php

/*
 * TA2ChaineJSON.php
 */

// Ouvre un fichier pour lire un contenu existant

$ville = array();
$ville["cp"] = "75000";
$ville["nom_ville"] = "Paris";

$chaineJSON = json_encode($ville);

var_dump($ville);
echo "<br><br>";
echo $chaineJSON;
file_put_contents("../ressources/paris.json", $chaineJSON);
?>

