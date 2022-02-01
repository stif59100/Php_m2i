<?php

header("Content-Type: text/html;charset=UTF-8");
// Récupération du contenu du fichier sous forme de flux de caractères
$contenuFichier = file_get_contents("https://data.gouv.nc/api/records/1.0/search/?dataset=liste-des-pays-et-territoires-etrangers&q=&rows=10000&facet=libenr");
// Affichage du contenu du fichier
//echo $contenuFichier;
// Lorsque ce paramètre vaut true, les objets JSON seront retournés comme tableaux associatifs ; lorsque ce paramètre vaut false, les objets JSON seront retournés comme des objets. 
// TA = json_decode(chaine, tableau_associatif = true)
// objet = json_decode(chaine, tableau_associatif = false)
// chaine: It is encoded string which must be UTF-8 encoded data
$jsonObjet = json_decode($contenuFichier);

$jsonArray = json_decode($contenuFichier, TRUE);
$dataInArray = $jsonArray["records"];
echo "<pre>";
//var_dump($dataInArray);
//var_dump($dataInObjet);
echo "</pre>";
echo "<hr>DATA Via un tableau de tableaux<hr>";
// Boucle sur le tableau des éléments du tableau

try {
    /*
     * Connexion
     */
    $connexion = new PDO("mysql:host=127.0.0.1;port=3306;dbname=poker;", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->exec("SET NAMES 'UTF8'");

    /*
     * INSERTION
     */
    $sql = "INSERT INTO pays(id_pays, nom_pays) VALUES(?,?)";
    $statement = $connexion->prepare($sql);

    for ($i = 0; $i < count($dataInArray); $i++) {
        // Affichage des valeurs des clés de chaque élément
        //echo $jsonObjet[$i]["name"] . " : " . $jsonObjet[$i]["lat"] . "<br>";
    echo $dataInArray[$i]["fields"]["codeiso3"]["libenr"] . "<br>";
        $pays = $dataInArray[$i]["fields"] . $dataInArray[$i]["codeiso3"] .$dataInArray[$i]["libenr"];
        $statement->bindValue(1, $id_pays);
        $statement->bindValue(2, $pays);

        $statement->execute();
    }
 ;


    $connexion = null;
} catch (PDOException $e) {
    $message = $e->getMessage();
}




?>