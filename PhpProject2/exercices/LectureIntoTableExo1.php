<?php
    // FichierLecture0.php
    header("Content-Type: text/html;charset=UTF-8");

    $fichier = "../ressources/personnages.txt";
    $contenu = "";
    // Ouverture pour lecture
    $canal = fopen($fichier, "r");
    // Lecture du fichier
    // Test jusqu'a la fin du fichier
    while(!feof($canal)) {
        // Lecture d'une ligne jusqu'au RC compris
        $ligne = fgets($canal);
        $contenu .= "$ligne<br/>";
    } /// boucle
    // Fermeture du fichier
    fclose($canal);
    // Affichage
    echo $contenu;
?>
