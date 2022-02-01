<?php

/*
  ApiVelib.php
  https://velib-metropole-opendata.smoove.pro/opendata/Velib_Metropole/system_information.json
 * 
 * 
  {
  "lastUpdatedOther": 1623414797,
  "ttl": 3600,
  "data": {
  "stations": [
  {
  "station_id": 213688169,
  "name": "Benjamin Godard - Victor Hugo",
  "lat": 48.865983,
  "lon": 2.275725,
  "capacity": 35,
  "stationCode": "16107"
  },
  {
  "station_id": 99950133,
  "name": "André Mazet - Saint-André des Arts",
 * cf aussi api.gouv.fr par exemple geo.api.gouv.fr
 * https://geo.api.gouv.fr/departements/33/communes?fields=nom,codesPostaux&format=json&geometry=centre
 */


header("Content-Type: text/html;charset=UTF-8");

// Récupération du contenu du fichier sous forme de flux de caractères
$contenuFichier = file_get_contents("https://velib-metropole-opendata.smoove.pro/opendata/Velib_Metropole/station_information.json");
// Affichage du contenu du fichier
//echo $contenuFichier;
// Lorsque ce paramètre vaut true, les objets JSON seront retournés comme tableaux associatifs ; lorsque ce paramètre vaut false, les objets JSON seront retournés comme des objets. 
// TA = json_decode(chaine, tableau_associatif = true)
// objet = json_decode(chaine, tableau_associatif = false)
// chaine: It is encoded string which must be UTF-8 encoded data

$jsonObjet = json_decode($contenuFichier);

$dataInObjet = $jsonObjet->data->stations;

echo "<pre>";
//var_dump($jsonObjet);
//var_dump($dataInObjet);
echo "</pre>";

echo "<hr>DATA Via un tableau d'objets<hr>";
// Boucle sur le tableau des objets
//echo "Nom" . " - " . "Latitude" . "," . "Longitude" . "<br>";
//for ($i = 0; $i < count($dataInObjet); $i++) {
//    echo $dataInObjet[$i]->name . " - " . $dataInObjet[$i]->lat . "," . $dataInObjet[$i]->lon . "<br>";
//}


$jsonArray = json_decode($contenuFichier, TRUE);
$dataInArray = $jsonArray["data"]["stations"];
echo "<pre>";
//var_dump($dataInArray);
//var_dump($dataInObjet);
echo "</pre>";
echo "<hr>DATA Via un tableau de tableaux<hr>";
// Boucle sur le tableau des éléments du tableau
for ($i = 0; $i < count($dataInArray); $i++) {
    // Affichage des valeurs des clés de chaque élément
    //echo $jsonObjet[$i]["name"] . " : " . $jsonObjet[$i]["lat"] . "<br>";
    echo $dataInArray[$i]["name"] . "<br>";
}
?>