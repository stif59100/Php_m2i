<?php

/*
 * TransaxionTest.php
 */

require_once '../lib/Connexion.php';
require_once '../lib/Transaxion.php';

$connection = seConnecter("../conf/cours.ini");

try {

    initialiser($connection);

    $sql = "INSERT INTO pays(id_pays, nom_pays) VALUES(?,?)";

    $statement = $connection->prepare($sql);

    $id = "SR";
    $nom = "Serbie";

    $statement->bindParam(1, $id, PDO::PARAM_STR);
    $statement->bindParam(2, $nom, PDO::PARAM_STR);

    $statement->execute();
    $rowCount = $statement->rowCount();
    echo "<br>Ligne(s) ajoutée(s) : $rowCount";

    //$lbOK = annuler($connection);
    $lbOK = valider($connection);
    echo "<br>$lbOK";
} catch (PDOException $exc) {
    echo $exc->getMessage();
    annuler($connection);
}

seDeconnecter($connection);
?>

