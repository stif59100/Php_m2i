<?php
// CookieSaisie.php
header("Content-Type: text/html;charset=UTF-8");
?>

<?php
$ut = setCookie("ut","");
if ($ut != null) {
    setCookie("ut", "");
    echo "Le cookie UT a été supprimé : " . $ut;
} else {
    echo "Saisie manquante";
}
?>
<br>
<a href='CookiesMenu.php'>Retour au menu</a>