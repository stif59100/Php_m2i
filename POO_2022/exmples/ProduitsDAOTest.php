<?php

require_once '../entities/Produits.php';
require_once '../daos/ProduitsDAO.php';

try {
    // Connexion
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'UTF8'");
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

echo "<hr>SELECT ALL<hr>";

$tObjects = ProduitsDAO::selectAll($pdo);
echo "<pre>";
var_dump($tObjects);
echo "</pre>";


echo "<hr>SELECT ONE<hr>";

$produit = ProduitsDAO::selectOne($pdo, 12);
echo "<pre>";
var_dump($produit);
echo "</pre>";

?>
