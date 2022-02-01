<?php

// AuthentificationCTRL.php

header("Content-Type: text/html; charset=UTF-8");

$message = "";

$pseudo = filter_input(INPUT_POST, "pseudo");
$mdp = filter_input(INPUT_POST, "mdp");

if ($pseudo != null && $mdp != null) {
    try {
        /*
         * Connexion
         */
        $connexion = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        // Le SELECT
        $select = "SELECT * FROM utilisateurs WHERE pseudo=? AND mdp=?";
        // Compilation du SELECT
        $curseur = $connexion->prepare($select);
        // Valorisation des paramètres
        $curseur->bindParam(1, $pseudo);
        $curseur->bindParam(2, $mdp);
        // Exécution du SELECT
        $curseur->execute();
        // Récupération ou pas d'un enregistrement
        // http://php.net/manual/fr/pdostatement.fetch.php
        $enregistrement = $curseur->fetch();
        if ($enregistrement === FALSE) {
            $message = "KO, vous n'êtes pas connecté(e)";
        } else {
            $message = "OK, vous êtes connecté(e)";
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