<?php

/*
 * TA2ChaineJSON.php
 */

$ville = array();
$ville["cp"] = "75000";
$ville["nom_ville"] = "Paris";

$chaineJSON = json_encode($ville);

var_dump($ville);
echo "<br><br>";
echo $chaineJSON;
?>