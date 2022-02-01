<?php
// FichierLecture2.php
header("Content-Type: text/html;charset=UTF-8");
//header("Content-Type: text/html;charset=ISO-8859-1");

$contenu = file_get_contents("../ressources/personnages.txt");

echo nl2br($contenu);
?>

