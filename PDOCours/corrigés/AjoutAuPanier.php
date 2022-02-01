<?php

/*
* AjoutAuPanier.php
*/
$id = filter_input(INPUT_GET, "id_produit");

echo "$id";


$panier = filter_input(INPUT_COOKIE, "caddie");
if ($panier == null) {
echo "Panier vide";
setcookie("caddie", $id, time() + 60 * 60 * 24 * 14);
} else {
echo "Panier non vide";
$panier .= "#" . $id;
setcookie("caddie", $panier, time() + 60 * 60 * 24 * 14);
}
?>