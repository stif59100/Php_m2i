<?php

// --- SQL paramétré : VillesInsertCTRL.php
header("Content-Type: text/html; charset=UTF-8");

$message = "";

$cp = filter_input(INPUT_POST, "cp");
$nomVille = filter_input(INPUT_POST, "nomVille");
$idPays = filter_input(INPUT_POST, "idPays");

if ($cp != null && $nomVille != null && $idPays != null) {

    try {
        /*
         * Connexion
         */
        $connexion = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        /*
         * INSERTION
         */
        $sql = "INSERT INTO villes(cp, nom_ville, id_pays) VALUES(?,?,?)";

        $statement = $connexion->prepare($sql);

        $statement->bindParam(1, $cp, PDO::PARAM_STR);
        $statement->bindParam(2, $nomVille, PDO::PARAM_STR);
        $statement->bindParam(3, $idPays, PDO::PARAM_STR);

        $statement->execute();

        $message = $statement->rowcount() . " enregistrement(s) ajouté(s)";

        $connexion = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Toutes les saisies sont obligatoires";
}

// echo $message;
include './VillesInsertIHM.php';
