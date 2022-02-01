<?php

/*
 * JsonLireFichierUn.php
 * Lire un fichier JSON qui contient un élément
 * {"cp":"24200","nom_ville":"Sarlat"}
 * Le fichier doit etre en UTF-8 sans BOM
 */

header("Content-Type: text/html;charset=UTF-8");

// Récupération du contenu du fichier sous forme de flux de caractères
$contenuFichier = file_get_contents("../ressources/ville.json");

// Affichage du contenu du fichier
echo $contenuFichier;

// json_decode(chaine, tableau_associatif = true)
// chaine: It is encoded string which must be UTF-8 encoded data
$jsonObjet = json_decode($contenuFichier, true);

// Affichage des valeurs des clés
echo "<hr>";
echo "Code postal : " . $jsonObjet["cp"];
echo "<br>Ville : " . $jsonObjet["nom_ville"];


// json_decode(chaine, objet PHP)
// chaine: It is encoded string which must be UTF-8 encoded data
$jsonObjet = json_decode($contenuFichier, false);

// Affichage des valeurs des attributs
echo "<hr>";
echo "Code postal : " . $jsonObjet->cp;
echo "<br>Ville : " . $jsonObjet->nom_ville;

?>

