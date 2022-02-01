<?php

header("Content-Type: text/html;charset=UTF-8");

$fichier = "insee.csv";
$canal = fopen($fichier, "r");
$ligne = fgets($canal);

echo "<pre>";
var_dump($ligne);
echo "</pre>";

// $contenu = file_get_contents("insee.csv");

// echo nl2br($contenu);




try {
    // Connexion
    // Récupération du contenu du fichier cours.ini dans un tableau associatif
    $tProprietes = parse_ini_file("../conf/cours.ini");

    // Récupération une à une des valeurs des clés du tableau associatif
    $host = $tProprietes["serveur"];
    $db = $tProprietes["bd"];
    $user = $tProprietes["ut"];
    $pwd = $tProprietes["mdp"];

    // Utilisation des variables dans le DSN et les autres paramètres
    $connexion = new PDO("mysql:host=$host;port=3306;dbname=$db;", $user, $pwd);

    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->exec("SET NAMES 'UTF8'");


    $sql = "INSERT INTO communes(commune,cp,dp,insee) VALUES(?,?,?,?)";
    $statement = $connexion->prepare($sql);

    $timestart = time();
    $connexion->beginTransaction();

    //Loop all lines and explode at each ; 
    while (!feof($canal)) {
        
        $ligne = fgets($canal);
        $ligne = trim($ligne);

        if ($ligne != "") {
            $tChamps = explode(";", $ligne);


            $statement->execute(array($tChamps[0], $tChamps[1],$tChamps[2],$tChamps[3]));

            // $message = $statement->rowcount() . " ville(s) ajoutée(s)";


            
            // echo $message;
        } //End of IF


    } //END of WHILE

    $connexion->commit();

    //Close the csv file
    $timerstop = time();
    echo $timestart;
    echo "<br>";
    echo $timerstop;
    echo "<br>";
    echo $timerstop-$timestart;
    fclose($canal);
} catch (PDOException $e) {
    $lsContenu = "Echec de l'exécution : " . $e->getMessage();
}
$connexion = null;
