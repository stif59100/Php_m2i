<?php

/*
 * PaysTest.php
 */
// C'est ici qu'il faut le préciser !!!
declare(strict_types = 1);

require_once '../entities/User.php';

$user = new User("1", "test", "test", "test", "test@gmail.com", "test");
echo "<br>" . $user->getIdUser() . ":" . $user->getNameUser(). ":" . $user->getFirstnameUser(). ":" . $user->getEmailUser(). ":" . $user->getPseudoUser(). ":" . $user->getPasswordUser();

$user->setIdUser("10");
$user->setNameUser("Vanderstocken");
$user->setFirstnameUser("Steeve");
$user->setEmailUser("steeve.vanderstocken@gmail.com");
$user->setPseudoUser("stif59100");
$user->setPasswordUser("test");


echo "<hr><pre>";
var_dump($user);
echo "</pre><hr>";

?>

