<?php

$idInput = filter_input(INPUT_GET, "id_produit");

if (!isset($_COOKIE["panier"])) {
    echo "le panier était vide";
    setcookie("panier", $idInput, time()+60*60*24*14, "/");

}else{
    
    $oldCookie = $_COOKIE["panier"];
    setcookie("panier", $oldCookie."#".$idInput, time()+60*60*24*14, "/");
    }

?>

