<?php

/* 
 * ChaineTests.php
 */

require_once 'Chaine.php';

$st = "BoNjoUr";

echo "<br>$st";

$s = Chaine::maj($st);
echo "<br>$s";

$s = Chaine::min($st);
echo "<br>$s";

?>
