<?php

/*
* AntiDoublonDansString.php
*/

$string = "1#2#1";
echo $string;
$t = explode("#", $string);

$tAssoc = array();
for ($i = 0; $i < count($t); $i++) {
$tAssoc[$t[$i]] = "";
}

echo "<pre>";
var_dump($tAssoc);
echo "</pre>";

$tKeys = array_keys($tAssoc);

echo "<pre>";
var_dump($tKeys);
echo "</pre>";

$string = implode("#", $tKeys);
echo $string;
?>