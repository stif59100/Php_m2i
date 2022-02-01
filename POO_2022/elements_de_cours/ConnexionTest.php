<?php
/*
 * ConnexionTest.php
 */
require_once '../lib/Connexion.php';

$connection = seConnecter("../conf/cours.ini");

echo "<br><pre>";
var_dump($connection);
echo "</pre><br>";

seDeconnecter($connection);
?>
