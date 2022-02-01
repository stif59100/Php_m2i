<?php

/* ObjetsJSON2ChaineJSON.php */
// Serialisation
include './Pays.php';

$fr = new Pays("33", "France");
$it = new Pays("39", "Italie");
$sp = new Pays("35", "Espagne");

$tPays = array();
$tPays[] = $fr;
$tPays[] = $it;
$tPays[] = $sp;

$chaineJSON = json_encode($tPays, JSON_PRETTY_PRINT);

var_dump($tPays);
echo "<br><br>";
echo $chaineJSON;
?>