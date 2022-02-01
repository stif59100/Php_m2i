<?php

// FichierLectureIntoTableExoV2.php
// Version générique
header("Content-Type: text/html;charset=UTF-8");

$fichier = "../ressources/personnages.txt";

// Si le fichier n'existe pas
if (file_exists($fichier)) {
    try {
        // Ouverture pour lecture
        $canal = fopen($fichier, "r");
        // Lecture du fichier
        $contenu = "<table border='1'>\n";
        $contenu .= "<thead>\n";
        $ligne = fgets($canal);
        $tLigne = explode(";", $ligne);
        $contenu .= "<tr>\n";
        foreach ($tLigne as $value) {
            $contenu .= "<th>$value</th>\n";
        }
        $contenu .= "</tr>\n";
        $contenu .= "</thead>\n";
        $contenu .= "<tbody>\n";
        // Test jusqu'a la fin du fichier
        while (!feof($canal)) {
            // Lecture d'une ligne jusqu'au RC compris
            $ligne = fgets($canal);
            // Suppression des RC, nbsp, tab, ...
            $ligne = trim($ligne);
            // Ajout dans la <table>
            if ($ligne != "") {
                $contenu .= "<tr>\n";
                $tLigne = explode(";", $ligne);
                foreach ($tLigne as $value) {
                    $contenu .= "<td>$value</td>\n";
                }
                $contenu .= "</tr>\n";
            }
        } /// boucle
        $contenu .= "</tbody>\n";
        $contenu .= "</table>\n";
        // Fermeture du fichier
        fclose($canal);
    } catch (Exception $e) {
        $contenu = $e->getMessage();
    }
} else {
    $contenu = "Le fichier $fichier n'existe pas !";
}
// Affichage
echo $contenu;
?>