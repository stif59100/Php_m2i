<?php
// personneUse1.php
require_once("Personne.php");

// Instanciation d'un objet et utilisation
$c = new Personne("Vanderstocken", 34);

echo "Nom : " . $c->getNom() . "<br>";
echo "Age : " . $c->getAge() . "<br>";
?>
