<?php

declare(strict_types=1);
// --- SQL paramétré : VillesInsertCTRLWithFunctions.php
header("Content-Type: text/html; charset=UTF-8");

/**
 * 
 * @param string $host
 * @param string $db
 * @param string $user
 * @param string $pwd
 * @return PDO
 */
function getConnection(string $host, string $db, string $user, string $pwd): PDO {
    try {
        // --- Connexion ... dans tous les cas
        $connection = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("SET NAMES 'UTF8'");
    } catch (PDOException $e) {
        echo $e;
        $connection = null;
    }
    return $connection;
}

/**
 * 
 * @param PDO $connexion
 * @param array $data
 * @return int
 */
function insert(PDO $connexion, array $data): int {
    try {
        $sql = "INSERT INTO villes(cp, nom_ville, id_pays) VALUES(?,?,?)";

        $statement = $connexion->prepare($sql);

        $statement->bindParam(1, $data["cp"], PDO::PARAM_STR);
        $statement->bindParam(2, $data["nomVille"], PDO::PARAM_STR);
        $statement->bindParam(3, $data["idPays"], PDO::PARAM_STR);

        $statement->execute();

        $affected = $statement->rowcount();
    } catch (Exception $e) {
        echo $e->getTraceAsString();
        $affected = -1;
    }
    return $affected;
}

$message = "";

$cp = filter_input(INPUT_POST, "cp");
$nomVille = filter_input(INPUT_POST, "nomVille");
$idPays = filter_input(INPUT_POST, "idPays");

if ($cp != null && $nomVille != null && $idPays != null) {
    /*
     * CALL CONNEXION
     */
    $connexion = getConnection("127.0.0.1", "cours", "root", "");
    /*
     * CALL INSERTION
     */
    $data = array("cp" => $cp, "nomVille" => $nomVille, "idPays" => $idPays);
    $message = insert($connexion, $data) . " enregistrement(s) ajouté(s)";

    $connexion = null;
} else {
    $message = "Toutes les saisies sont obligatoires";
}

// echo $message;
include './VillesInsertIHM.php';
