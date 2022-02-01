<?php
// CookieAffichage.php
header("Content-Type: text/html;charset=UTF-8");

$ut = filter_input(INPUT_COOKIE, "ut");
if ($ut != null) {
    echo "Cookie <strong>Nom d'utilisateur</strong> : " . $ut;
} else {
    echo "Cookie <strong>Utilisateur inexistant </strong>";
}
?>
<br>
<a href='CookiesMenu.php'>Retour au menu</a>

