<?php

/*
 * ../controls/InscriptionCTRLV5.php
 */

/*
 * Récupération des saisies (IN)
 */
$pseudo = filter_input(INPUT_GET, "pseudo");
$mdp = filter_input(INPUT_GET, "mdp");
$jour = filter_input(INPUT_GET, "jour");
$mois = filter_input(INPUT_GET, "mois");
$annee = filter_input(INPUT_GET, "annee");
$ville = filter_input(INPUT_GET, "ville");

echo "<hr>$mois<hr>";

$sexe = filter_input(INPUT_GET, "rb_sexe");
$cbx_salarie = filter_input(INPUT_GET, "cbx_salarie");
$cbx_independant = filter_input(INPUT_GET, "cbx_independant");

$description = filter_input(INPUT_GET, "description");

// --- listeMultiple.php
$vals = "";
$selections = filter_input(INPUT_GET, 'hobbies', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($selections != null && $selections[0] != "-1") {
    $vals = implode("-", $selections);
    echo "Sélections des hobbies : $vals<br>";
} else {
    echo "Pas de sélection de hobbie !<br>";
}

/*
 * Analyse (TRT)
 */
$nbErreurs = 0;
$message = "";

if ($pseudo == null) {
    $message .= "Pseudo manquant !<br>";
    $nbErreurs++;
}
if ($mdp == null) {
    $message .= "MDP manquant !<br>";
    $nbErreurs++;
}
if ($jour == null || $jour == "0") {
    $message .= "Jour manquant !<br>";
    $nbErreurs++;
}
if ($mois == null || $mois == "0") {
    $message .= "Mois manquant !<br>";
    $nbErreurs++;
}
if ($annee == null || $annee == "0") {
    $message .= "Année manquante !<br>";
    $nbErreurs++;
}

if ($ville == "0") {
    $message .= "Ville manquante !<br>";
    $nbErreurs++;
}

if ($cbx_salarie == null && $cbx_independant == null) {
    $message .= "Ni salarié ni indépendant !!!<br>";
    $nbErreurs++;
}

if ($sexe == null) {
    $message .= "Pas de sexe !!!<br>";
    $nbErreurs++;
}

if ($description == null) {
    $message .= "Description manquante !<br>";
    $nbErreurs++;
}


/*
 * "Affichage" (OUT)
 */
if ($nbErreurs == 0) {
    $message = "Jusque là tout va bien !<br>";
}
echo $message;
?>
