

<?php
header("Content-Type: text/html; charset=UTF-8");


$cp = filter_input(INPUT_GET, "cp");


if($cp !== null){
    try {
        // Connexion
        $connexion = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");
    
        // Préparation et exécution du SELECT SQL
        $select = "SELECT nom_ville, id_pays FROM villes where cp=$cp";
        $curseur = $connexion->query($select);
        $curseur->setFetchMode(PDO::FETCH_NUM);
    
        $contenu = "";
        
    
        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
        foreach ($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $contenu .= "ID PAYS <input value='$enregistrement[1]'/> VILLE :<input name='newVille' value='$enregistrement[0]'/><input type='hidden' name='ville' value='$enregistrement[0]'/>";
            
        }
        
        // Fermeture du curseur (facultatif)
        $curseur->closeCursor();
        
    }
    // Gestion des erreurs
    catch (PDOException $e) {
        $contenu = "Echec de l'exécution : " . $e->getMessage();
    }
    
    // Déconnexion (facultative)
    $connexion = null;
}



include './VillesUpdatePrepare.php';