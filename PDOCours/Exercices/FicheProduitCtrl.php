<?php

// FicheProduitCTRL.php

header("Content-Type: text/html; charset=UTF-8");

$message = "";
$contenu = "";

$designation = filter_input(INPUT_GET, "designation");

echo $designation;


if ($designation != null ) {
    try {
        /*
         * Connexion
         */
        $connexion = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        // Le SELECT
        $select = "SELECT * FROM produits WHERE designation=?";
        // Compilation du SELECT
        $curseur = $connexion->prepare($select);
        // Valorisation des paramètres
        $curseur->bindParam(1, $designation);
        // Exécution du SELECT
        $curseur->execute();
        // Récupération ou pas d'un enregistrement
        // http://php.net/manual/fr/pdostatement.fetch.php
        $enregistrement = $curseur->fetch();
        

        if ($enregistrement === FALSE) {
            $message = "Veuillez saisir un produit existant";
        } else {
          $message .= "id=$enregistrement[0]";
          $message .= "designation=$enregistrement[1]<br>";
          $message .= "prix=$enregistrement[2]<br>";
          $message .= "quantité=$enregistrement[3]<br>";
          $message .= "photo=<img src='../images/$enregistrement[4]'><br>";
          $message .= "catégorie=$enregistrement[5]";


        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage() . "<br>";
    }
    $connexion = null;
} else {
    $message = "Toutes les saisies sont obligatoires !!!";
}

echo $message;
?>