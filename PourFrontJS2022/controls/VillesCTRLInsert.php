<?php

/*
 * VillesCTRLInsert.php
 */

/*
Access to XMLHttpRequest at 'http://127.0.0.1/PourFrontJS2022/controls/VillesCTRLDelete.php' from origin 'http://localhost' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource.
127.0.0.1/PourFrontJS2022/controls/VillesCTRLDelete.php:1 Failed to load resource: net::ERR_FAILED
 */
/*
 * Pour autoriser les requêtes à partir d'un autre domaine
 */

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");

require_once '../daos/ConnectionDB.php';
require_once '../daos/VillesDAO.php';

$connection = getConnection("127.0.0.1", "cours", "root", "");

$cp = filter_input(INPUT_POST, "cp");
$nomVille = filter_input(INPUT_POST, "nomVille");
$site = filter_input(INPUT_POST, "site");
$photo = filter_input(INPUT_POST, "photo");
$idPays = filter_input(INPUT_POST, "idPays");

$data = array("cp" => $cp, "nomVille" => $nomVille, "site" => $site, "photo" => $photo, "idPays" => $idPays);

$affected = insert($connection, $data);

$array = array("ajout" => $affected);
$json = json_encode($array);

echo $json;
?>
