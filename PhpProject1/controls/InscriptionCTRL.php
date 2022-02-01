<?php

$pseudo = filter_input(INPUT_GET, "pseudo");
if ($pseudo == null) {
    $pseudo = "Pseudo vide !!!";
} else {
    echo $pseudo;
}




echo "<br />";

$mdp = filter_input(INPUT_GET, "mdp");
if ($mdp == null) {
    echo "Veuillez saisir un mot de passe !!!";
} else {
    echo $mdp;
}




echo "<br />";



$jour = filter_input(INPUT_GET, "listeJours");
if ($jour != null) {
    echo "Date de naissance: " . $jour;
}

$mois = filter_input(INPUT_GET, "listeMois");
if ($mois != null) {
    echo "/" . $mois;
}

$annee = filter_input(INPUT_GET, "listeAnnée");
if ($annee != null) {
    echo "/" . $annee;
}

echo "<br />";
$ville = filter_input(INPUT_GET, "listeVille");
if ($ville != null) {
    echo "CP: " . $ville;
} else {
        echo "Veuillez sélectionner une ville";
}

echo "<br />";


$btValider = filter_input(INPUT_GET, "btValider");
echo $btValider;
