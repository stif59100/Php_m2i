<?php

/*
 * JsonLireFichierPlusieurs.php
 * Lire un fichier JSON qui contient plusieurs éléments
 * [ {"id_pays": "033", "nom_pays": "France"}, {"id_pays": "039", "nom_pays": "Italie"}, {"id_pays": "034", "nom_pays": "Espagne"}, {"id_pays": "035", "nom_pays": "Angleterre"}, {"id_pays": "000", "nom_pays": "Belgique"} ]
 * Le fichier doit etre en UTF-8 sans BOM
 */

header("Content-Type: text/html;charset=UTF-8");

// Récupération du contenu du fichier sous forme de flux de caractères
$contenuFichier = file_get_contents("../ressources/pays.json");
// Affichage du contenu du fichier
echo $contenuFichier;

// json_decode(chaine, tableau_associatif = true)
// chaine: It is encoded string which must be UTF-8 encoded data
$jsonObjet = json_decode($contenuFichier, true);

echo "<hr>";
// Boucle sur le tableau des éléments du tableau
for ($i = 0; $i < count($jsonObjet); $i++) {
    // Affichage des valeurs des clés de chaque élément
    echo $jsonObjet[$i]["id_pays"] . " : " . $jsonObjet[$i]["nom_pays"] . "<br>";
}
?>


Pour afficher en mode objet

$jsonObjet = json_decode($contenuFichier, false);

// Boucle sur le tableau des éléments du tableau d'objets
for ($i = 0; $i < count($jsonObjet); $i++) {
    // Affichage des valeurs des attributs de chaque élément
    echo $jsonObjet[$i]->id_pays . " : " . $jsonObjet[$i]->nom_pays . "<br>";
}

