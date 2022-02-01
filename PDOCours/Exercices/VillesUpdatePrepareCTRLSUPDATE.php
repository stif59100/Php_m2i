

<?php
header("Content-Type: text/html; charset=UTF-8");

$cp = filter_input(INPUT_POST, "cp");
$newVille = filter_input(INPUT_POST, "newVille");
$ville = filter_input(INPUT_POST, "ville");
echo $ville;
echo $newVille;




if($ville !== null){
    try {
        // Connexion
        $connexion = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");
    
        // Préparation et exécution du SELECT SQL
        $sql = "UPDATE villes SET nom_ville=? where nom_ville=?";
        $statement = $connexion->prepare($sql);
        $statement->bindParam(1, $newVille, PDO::PARAM_STR);
        $statement->bindParam(2, $ville, PDO::PARAM_STR);
       

        $statement->execute();

       $message = $statement->rowcount() . " mise à jour effectuée";

        $connexion = null;
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Veuillez choisir une ville";

        
    }
    
    
    // Déconnexion (facultative)
    $connexion = null;




include './VillesUpdatePrepareCTRLSELECT.php';