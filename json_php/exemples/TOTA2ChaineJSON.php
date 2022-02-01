<?php

/* TOTAs2ChaineJSON.php */

$villes = array();

$ville = array();

$ville["cp"] = "75000";
$ville["nom_ville"] = "Paris";
$villes[] = $ville;

$ville["cp"] = "69000";
$ville["nom_ville"] = "Lyon";
$villes[] = $ville;

$ville["cp"] = "24200";
$ville["nom_ville"] = "Sarlat";
$villes[] = $ville;

$chaineJSON = json_encode($villes);

var_dump($villes);
echo "<br><br>";
echo $chaineJSON;

echo "<br><br>Le JSON a été enregistré sur le DD";
file_put_contents("../ressources/villes.json", $chaineJSON);

?>