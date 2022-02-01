<?php

require_once './ConnectionDB.php';
require_once './dao.php';

// --- Connexion ... dans tous les cas
$connection = getConnection("127.0.0.1", "poker", "root", "");

/*
 * CALL SELECT ALL
 */
$t = users($connection);

echo "<pre>";
var_dump($t);
echo "</pre><hr>";

echo "<hr>SELECT ONE <hr>";
$t = selectUser($connection, "stif59100");

echo "<pre>";
var_dump($t);
echo "</pre><hr>";

//$data = array("name_user" => "testDAO", "firstname_user" => "testDAO", "pseudo_user" => "testDAO", "email_user" => "testDAO", "password_user" => "testDAO");
//$affected = register($connection, $data);
//echo "<hr>Insert : $affected";

//$affected = delete($connection, "testDAO");
//echo "<hr>Delete : $affected";

//$data["pseudo_user"] = "testD";
//$affected = update($connection, "testDAO", $data);
//echo "<hr>Update : $affected";

// --- Deconnexion
$connection = null;
?>

