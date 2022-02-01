<?php

// --- SQL parametre : ProduitsInsertCTRL.php
header("Content-Type: text/html; charset=UTF-8");
$message = "";

$btInsert = filter_input(INPUT_GET, "btInsert");
if ($btInsert != null) {
    $designation = filter_input(INPUT_GET, "designation");
    $prix = filter_input(INPUT_GET, "prix");
    if ($designation != null && $prix != null) {
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
            $sql = "INSERT INTO produits(designation, prix) VALUES(?,?)";
            $statement = $connexion->prepare($sql);
            $statement->bindParam(1, $designation);
            $statement->bindParam(2, $prix);
            $statement->execute();
            $message = $statement->rowcount() . " enregistrement(s) ajouté(s)<br>";
            $message .= "Le nouvel ID : " . $connexion->lastInsertId();

            $connexion = null;
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    } else {
        $message = "Toutes les saisies sont obligatoires";
    }
}
include './ProduitsInsertIHM.php';