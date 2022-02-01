<?php
// CookieTest.php
$attributVerif = filter_input(INPUT_GET, "verif");

// --- Premier passage
if ($attributVerif == null) {
    setcookie("cookie_verif", "1");
    $url = filter_input(INPUT_SERVER, "PHP_SELF") . "?verif=1";
    header("Location: $url");
    exit();
}



// --- Deuxième passage
if ($attributVerif != null) {
    $cookieVerif = filter_input(INPUT_COOKIE, "cookie_verif");
    if ($cookieVerif != null) {
        echo "Votre navigateur prend en charge les cookies ...";
    } else {
        echo "Votre navigateur <strong>ne prend pas</strong> en charge les cookies";
    }
}
?>