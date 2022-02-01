<?php
// SessionOnePage.php
session_start();
header("Content-Type: text/html;charset=UTF-8");
?>

<form action="" method="get">
    <label>Nom d'utilisateur : </label>
    <input type="text" name="prenom" value="Pascal" />
    <input type="submit" name="btCreer" value="Créer"/>
    <input type="submit" name="btAfficher" value="Afficher"/>
    <input type="submit" name="btDetruire" value="Détruire"/>
</form>

<?php
$prenom = filter_input(INPUT_GET, "prenom");

if (filter_input(INPUT_GET, "btCreer") != null) {
    $_SESSION['prenom'] = $prenom;
    echo "Variable de session créée";
    echo "<br>Prénom : " . $_SESSION['prenom'];
}

if (filter_input(INPUT_GET, "btAfficher") != null) {
    if (isSet($_SESSION["prenom"])) {
        echo "Variable <strong>prenom</strong> : " . $_SESSION["prenom"];
    } else {
        echo "Variable <strong>prenom</strong> inexistante";
    }
}

if (filter_input(INPUT_GET, "btDetruire") != null) {
    $bExists = array_key_exists("prenom", $_SESSION);
    if ($bExists) {
        echo "<br/>Destruction de la variable de session <strong>prenom</strong>";
        unset($_SESSION["prenom"]);
    } else {
        echo "Variable <strong>prenom</strong> inexistante";
    }
}
?>

