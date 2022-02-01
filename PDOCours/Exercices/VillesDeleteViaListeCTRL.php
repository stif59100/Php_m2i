

<?php
// --- SQL paramétré : VillesDeleteViaListeCTRL.php
header("Content-Type: text/html; charset=UTF-8");

$message = "";

$cp = filter_input(INPUT_POST, "cp");


if ($cp != null) {

    try {
        /*
         * Connexion
         */
        $connexion = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        /*
         * Suppression
         * 
         */
        $sql = "DELETE FROM villes WHERE cp=?";

        $statement = $connexion->prepare($sql);
        $statement->bindParam(1, $cp, PDO::PARAM_STR);
       

        $statement->execute();

        $message = $statement->rowcount() . " Suppression effectuée";

        $connexion = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Veuillez choisir une ville";
}

include './VillesDeleteViaListe.php';