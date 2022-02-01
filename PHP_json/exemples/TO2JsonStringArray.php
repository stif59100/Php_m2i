<?php

/*
 * TO2JsonStringArray.php
 * Ordinal Array 2 JSON String of Objects Array
 */

$tVilles = array("Paris", "Lyon", "Marseille");

$tObjects = array();
foreach ($tVilles as $value) {
    $tObject = array();
    $tObject["nomVille"] = $value;
    $tObjects[] = $tObject;
}

$jsonString = json_encode($tObjects);

var_dump($tObjects);
echo "<br><br>";
echo $jsonString;
?>
