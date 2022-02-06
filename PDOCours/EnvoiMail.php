<?php



/*
* EnvoirMail.php
*/



// A CHANGER
ini_set("SMTP", "smtp.gmail.com");
ini_set("smtp_port", "25");
// --- Remplace le FROM dans les entêtes
//ini_set("sendmail_from", "buguet-pascal@bbox.fr");



// A CHANGER
$destinataire = "steeve.vanderstocken@gmail.com";
// --- utf8_decode() : UTF8 vers ISO 8859-1
$objet = utf8_decode("Mot de passe oublié");
$message = "Va voir le lien https://www.lensois.com";



$entetes = "Content-Type: text/plain; charset=UTF-8\r\n";
// A CHANGER
$entetes .= "Cc: stif59100@gmail.com\r\n";
// A CHANGER
$entetes .= "From: steeve.vanderstocken@gmail.com\r\n";



$bOk = mail($destinataire, $objet, $message, $entetes);
if ($bOk) {
$message = "Mail envoy&eacute; avec succ&egrave;s";
} else {
$message = "Erreur d'envoi du Mail";
}
echo $message;