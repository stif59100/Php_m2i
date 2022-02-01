<?php

// FichierLectureIntoTableExo1.php
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

        // $contenu .= "<tr><th>" . fgets($canal) . "</th></tr>\n";
        $ligne = fgets($canal);
        $tChamps = explode(";", $ligne);
        $contenu .= "<tr>";
        $contenu .= "<th>" . $tChamps[0] . "</th>";
        $contenu .= "<th>" . $tChamps[1] . "</th>";
        $contenu .= "<th>" . $tChamps[2] . "</th>";
//        $contenu = implode("<th>", $tChamps); // Eh non ! Dommage !
        $contenu .= "</tr>";

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
                // $contenu .= "<tr><td>$ligne</td></tr>\n";
                $tChamps = explode(";", $ligne);
                $contenu .= "<tr>\n";
                $contenu .= "<td>" . $tChamps[0] . "</td>";
                $contenu .= "<td>" . $tChamps[1] . "</td>";
                $contenu .= "<td>" . $tChamps[2] . "</td>";
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