<?php
// Début du fichier PHP
/*
  copieInsee.php
  Commune;Codepos;Departement;INSEE -> INSEE,Codepos,Commune,Departement
 */
header("Content-Type: text/html;charset=UTF-8");

// Je créer une variable “$fichierIN” à laquelle j’affecte le chemin relatif du fichier que l’on doit //lire
$fichierIN = "../ressources/insee.csv";
//Je crée une variable”$fichierOUT” pour la copie du “$fichierIN”
$fichierOUT = "../ressources/inseeCopie.csv";
//Je crée une variable “$fichierLOG” pour récupérer les erreurs
$fichierLOG = "../ressources/inseeCopie.log";
//Création d’une variable qui contient une chaîne de caractères vide
$message = "";
//on crée une variable qui retourne le nombre de secondes écoulées depuis le 01/01/1970
$debut = time();

echo date("D d M Y H:i:s:u");

// Si le fichier n'existe pas
if (file_exists($fichierIN)) {
    try {
//Création des variables qui vont ouvrir/créer les différents fichiers
        $in = fopen($fichierIN, "r");
        $out = fopen($fichierOUT, "w+");
        $log = fopen($fichierLOG, "w+");
    // je crée une variable nbLigne pour compter le nombre de ligne
        $nbLigne = 1;
    // Tant que la lecture du fichier n’est pas fini..
        while (!feof($in)) {
            // Lecture d'une ligne jusqu'au RC compris
            $ligneIN = fgets($in);
//Si “$ligneIN” ne contient pas d’espace alors…
            if (trim($ligneIN) != "") {
                // AMBLEON;01300;AIN;1006
//je crée une variable , à partir du fichier insee.csv, qui va exploser une //chaîne de caractère dans un tableau  et qui supprime les ;
                $tChamps = explode(";", $ligneIN);
//Si le nombre de valeurs de “$tChamps” est égale à 4 alors…(“$tChamps” est ici un //tableau)
                if (count($tChamps) == 4) {
// Création d’une variable qui va concaténer les éléments du tableau désignés selon leur index //après avoir supprimé les caractères invisibles avant et après
// et ajout à la fin de \r\n ie passage à la ligne suivante
                    $ligneOUT = trim($tChamps[3]) . "," . $tChamps[1] . "," . $tChamps[0] . "," . $tChamps[2] . "\r\n";
//envoi des données “$ligneOUT” dans la variable $out (donc écriture dans “$fichierOUT”)
                    fputs($out, $ligneOUT);
                    fflush($out);
                } else {
                    $ligneOUT = "Problème à la ligne $nbLigne\r\n";
                    fputs($log, $ligneOUT);
                }
            } else {
                $ligneOUT = "Problème à la ligne $nbLigne, chaîne vide \r\n";
                fputs($log, $ligneOUT);
            }
//Incrémentation de la variable NbLigne après la lecture de chaque ligne
            $nbLigne++;
        } /// boucle
//Fermeture des différents fichiers
        fclose($in);
        fclose($out);
        fclose($log);
//Confirmation de la copie
        $message = "Copie terminée :-)";
    } 
//En cas de problèmes sur le “try”
catch (Exception $ex) {
        $message = $ex->getMessage();
    }
} else 
{
//Ecraser $message en cas d’erreur de lecture et remplacer par cette phrase
    $message = "Le fichier $fichierIN n'existe pas !!!";
}

$fin = time();
//Affiche le temps écoulé en ms entre $fin et $début
echo $fin - $debut;
//Affichage $message et horizontal row
echo "<hr>$message";

echo "<hr>", date("D d M Y H:i:s:u");?>
