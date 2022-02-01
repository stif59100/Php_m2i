<?php
/**
 * Connexion.php : une bibliothèque
 *
 * seConnecter() : PDO(à partir d'un fichier ini)
 * seDeconnecter() : void
 */

/**
 *
 * @param string $psCheminParametresConnexion
 * @return PDO
 */
function seConnecter(string $psCheminParametresConnexion) : PDO {

    $tProprietes = parse_ini_file($psCheminParametresConnexion);

    $lsProtocole = $tProprietes["protocole"];
    $lsServeur = $tProprietes["serveur"];
    $lsPort = $tProprietes["port"];
    $lsUT = $tProprietes["ut"];
    $lsMDP = $tProprietes["mdp"];
    $lsBD = $tProprietes["bd"];

    /*
     * Connexion
     */
    $connection = null;
    try {
        $connection = new PDO("$lsProtocole:host=$lsServeur;port=$lsPort;dbname=$lsBD;", $lsUT, $lsMDP);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$connection->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
        $connection->exec("SET NAMES 'UTF8'");
    } catch (PDOException $ex) {
        //echo "<br>" . $ex->getMessage();
    }
    return $connection;
}

/**
 *
 * @param PDO $pcnx
 */
function seDeconnecter(PDO &$pcnx) {
    $pcnx = null;
}
?>