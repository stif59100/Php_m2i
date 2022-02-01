<?php

/*
 * ProduitsTest.php
 */
// C'est ici qu'il faut le préciser !!!
declare(strict_types=1);

require_once '../entities/Produits.php';

/*
 * SANS ID
 */
$coca = new Produits("Coca", 1, 100, "coca.jpg", "soda");

// Utilisation de GETTERS
echo $coca->getDesignation();
echo "<br>Prix : " . $coca->getPrix();

// Et un var_dump
echo "<hr><pre>";
var_dump($coca);
echo "</pre>";

// Utilisation du SETTER
$coca->setPrix(1.1);

echo "<hr><pre>";
var_dump($coca);
echo "</pre>";



/*
 * AVEC UN ID
 */
$vichy = new Produits("Vichy", 1.3, 36, "vichy.jpg", "eau", 17);
echo "<hr><pre>";
var_dump($vichy);
echo "</pre>";
?>
