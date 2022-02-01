<?php

declare(strict_types=1);
// --- VillesUpdatePrepareCTRL.php
// A exécuter en premier
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
 * @param PDO $connection
 * @return array
 */
function selectAll(PDO $connection): array {
    try {
        $sql = "SELECT cp, nom_ville FROM villes ORDER BY nom_ville";
        $cursor = $connection->query($sql);
        // Tableau ordinal de tableaux associatifs
        $array = array();
        while ($record = $cursor->fetch()) {
            // Tableau associatif
            $ligne = array("cp" => $record[0], "nomVille" => $record[1]);
            // Ajout dans le tableau ordinal
            $array[] = $ligne;
        }
        $cursor->closeCursor();
    } catch (Exception $e) {
        echo $e->getTraceAsString();
        $array = array();
    }
    return $array;
}

/**
 * 
 * @param PDO $connection
 * @param string $pk
 * @return array
 */
function selectOne(PDO $connection, string $pk): array {
    try {
        // Le selectOne()
        $sql = "SELECT cp, nom_ville, id_pays FROM villes WHERE cp = ?";

        $cursor = $connection->prepare($sql);
        $cursor->bindValue(1, $pk);
        $cursor->execute();

        $record = $cursor->fetch();

        $array = array("cp" => $record["cp"], "nomVille" => $record["nom_ville"], "idPays" => $record["id_pays"]);    
    } catch (Exception $e) {
        echo $e->getTraceAsString();
        $array = array();
    }
    return $array;
}

/**
 * 
 * @param PDO $connection
 * @param string $pk
 * @param array $data
 * @return int
 */
function update(PDO $connection, string $pk, array $data): int {
    try {
        $sql = "UPDATE villes SET nom_ville=?, id_pays=? WHERE cp=?";

        $statement = $connection->prepare($sql);

        $statement->bindParam(1, $data["nomVille"]); // BIND = RELIER
        $statement->bindParam(2, $data["idPays"]);
        $statement->bindParam(3, $pk);

        $statement->execute();
        //$statement->execute(array($nomVille, $idPays, $cp));

        $affected = $statement->rowcount();
    } catch (Exception $e) {
        echo $e->getTraceAsString();
        $affected = -1;
    }
    return $affected;
}

/*
 * MAIN
 */
$message = "";

// --- Ville précédemment sélectionnée
$cp = filter_input(INPUT_POST, "lbVilles");
$nomVille = filter_input(INPUT_POST, "nomVille");
$idPays = filter_input(INPUT_POST, "idPays");

try {
    // --- Connexion ... dans tous les cas
    $connection = getConnection("127.0.0.1", "cours", "root", "");

    /*
     * CALL SELECT ONE
     * Si l'utilisateur a cliqué sur le bouton "SELECTIONNER"
     * Selection : affichage de la ville selectionnee dans les inputs
     * 
     */
    $btSelectionner = filter_input(INPUT_POST, "btSelectionner");
    if ($btSelectionner != null) {
        $data = selectOne($connection, $cp);
        $nomVille = $data["nomVille"];
        $idPays = $data["idPays"];
    } // fin if btSelectionner

    /*
     * CALL UPDATE
     * Si l'utilisateur a cliqué sur le bouton "MODIFIER"
     */
    $btModifier = filter_input(INPUT_POST, "btModifier");
    if ($btModifier != null) {
        $data = array();
        $data["nomVille"] = $nomVille;
        $data["idPays"] = $idPays;
        $affected = update($connection, filter_input(INPUT_POST, "lbVilles"), $data);
        $message = $affected . " enregistrement(s) modifié(s)";
    } // fin if btModifier

    /*
     * CALL SELECT ALL
     * Remplissage de la liste des villes
     */
    $array = selectAll($connection);
//    echo "<pre>";
//    var_dump($array);
//    echo "</pre>";
    $options = "";
    for ($i = 0; $i < count($array); $i++) {
        // --- Option à sélectionner
        if ($cp != null AND $array[$i]["cp"] == $cp) {
            $options .= "<option value='" . $array[$i]["cp"] . "' selected='selected'>" . $array[$i]["nomVille"] . "</option>\n";
        } else {
            $options .= "<option value='" . $array[$i]["cp"] . "'>" . $array[$i]["nomVille"] . "</option>\n";
        }
    }
    // --- Deconnexion
    $connection = null;
} // fin try
catch (PDOException $e) {
    $message = $e->getMessage();
}

include './VillesUpdatePrepareeIHM.php';
?>

