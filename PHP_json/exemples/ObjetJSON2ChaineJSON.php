<?php

/* ObjetJSON2ChaineJSON.php */
// Serialisation
include './Pays.php';

$objetJSON = new Pays("33", "France");

$chaineJSON = json_encode($objetJSON, JSON_PRETTY_PRINT);

var_dump($objetJSON);
echo "<br><br>";
echo $chaineJSON;
?>
