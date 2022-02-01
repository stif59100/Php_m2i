<?php

/*
 * CSV2JsonFile.php
 */

header("Content-Type: text/html;charset=UTF-8");

try {

    $fichier = "../ressources/pays.csv";
    $lsContenu = "";
    // --- Ouverture pour lecture
    $canal = fopen($fichier, "r");
    // --- Lecture du fichier
    // --- La ligne des entetes
    $ligne = fgets($canal);
    $tEntetes = explode(",", trim($ligne));

    $tPays = array();
    // --- Test jusqu'a la fin du fichier
    while (!feof($canal)) {
        // --- Lecture d'une ligne jusqu'au RC compris
        $ligne = fgets($canal);
        if (trim($ligne) != "") {
            $tValeurs = explode(",", trim($ligne));
            $ta = array_combine($tEntetes, $tValeurs);
            $tPays[] = $ta;
        }
    } /// boucle
    $chaineJSON = json_encode($tPays);

    // --- Fermeture du fichier
    fclose($canal);

    file_put_contents("../ressources/pays_from_csv.json", $chaineJSON);

    echo "<hr>Transfert CSV to JsonFile terminé";


    /**
     *
     */
    echo "<hr>Re-lecture pour contrôle<hr>";

    // Récupération du contenu du fichier sous forme de flux de caractères
    $contenuFichier = file_get_contents("../json/pays_from_csv.json");

    // json_decode(chaine, tableau_associatif = true)
    // chaine: It is encoded string which must be UTF-8 encoded data
    $jsonObjet = json_decode($contenuFichier, false);

    // Boucle sur le tableau des éléments du tableau
    for ($i = 0; $i < count($jsonObjet); $i++) {
        // Affichage des valeurs des attributs de chaque élément
        echo $jsonObjet[$i]->id_pays . " : " . $jsonObjet[$i]->nom_pays . "<br>";
    }
    } catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
?>
