<?php
// --- ClientsSelectParameterWithBindParam.php
header("Content-Type: text/html; charset=UTF-8");
$message = "";

$cp = filter_input(INPUT_GET, "cp");

if ($cp != null) {
    try {
        $connexion = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        // ORDRE SQL
        // Cette instruction SQL autorise les INJECTIONS SQL
        //$sql = "SELECT * FROM clients WHERE cp = " . $cp;
        // Cette instruction SQL n’autorise pas les INJECTIONS SQL
        $sql = "SELECT * FROM clients WHERE cp = ?";
        // COMPILATION
        $curseur = $connexion->prepare($sql);
        // VALORISATION DU PARAMETRE
        $curseur->bindParam(1, $cp);
        // EXECUTION DE LA REQUETE
        $curseur->execute();

        while ($enregistrement = $curseur->fetch()) {
            $message .= "$enregistrement[0]-$enregistrement[1]-$enregistrement[2]-$enregistrement[5]<br>";
        }
        $connexion = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
}
?>

<form action="" method="get">
    <label>Code postal ? </label>
    <input type="text" name="cp" value="75011" />
    <input type="submit" />
</form>

<label>
    <?php echo $message; ?>
</label>
