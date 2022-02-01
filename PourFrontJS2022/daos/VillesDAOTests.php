<?php

require_once './ConnectionDB.php';
require_once './VillesDAO.php';

// --- Connexion ... dans tous les cas
$connection = getConnection("127.0.0.1", "cours", "root", "");

/*
 * CALL SELECT ALL
 */
$t = selectAll($connection);

echo "<pre>";
var_dump($t);
echo "</pre><hr>";

echo "<hr>SELECT ONE <hr>";
$t = selectOne($connection, "75011");

echo "<pre>";
var_dump($t);
echo "</pre><hr>";

$data = array("cp" => "75021", "nomVille" => "Paris XXI", "site" => "www.paris21.fr", "photo" => "paris_21.png", "idPays" => "033");
$affected = insert($connection, $data);
echo "<hr>Insert : $affected";

//$affected = delete($connection, "75021");
//echo "<hr>Delete : $affected";

$data["nomVille"] = "Paris XXI";
$affected = update($connection, "75021", $data);
echo "<hr>Update : $affected";

// --- Deconnexion
$connection = null;
?>
