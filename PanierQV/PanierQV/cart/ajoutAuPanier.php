<?php

$diese = false;
$idInput = filter_input(INPUT_GET, "id_produit");

if (!isset($_COOKIE["panier"])) {
    echo "le panier était vide";

    $firstadd = $idInput;

    setcookie("panier", $firstadd);
}else{
    if (isset($_COOKIE["panier"])) {
    $oldCookie = $_COOKIE["panier"];
    var_dump($oldCookie);
    $diese = explode("#", $oldCookie);
   
    }

    if ($diese = true) {
        $oldDecode = explode('#', $oldCookie);
        var_dump($oldDecode);
        $newCookie = "";
        foreach ($oldDecode as $i) {
            $newCookie .= $i . "#";
        }
        $newCookie .= $idInput;
        setCookie("panier", $newCookie);
    }
else{
    var_dump($oldCookie[0] ."ohno");
    $oneAdd = $oldCookie[0] . "#". $idInput;
    setcookie("panier", $oneAdd);

}
}






?>

