<!DOCTYPE html>
<!--
Csv2Select.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
    // --- VillesSelect.php
    header("Content-Type: text/html; charset=UTF-8");

    try {
        // Connexion
        $connexion = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        // Préparation et exécution du SELECT SQL
        $select = "SELECT cp, nom_ville FROM villes";
        $curseur = $connexion->query($select);
        $curseur->setFetchMode(PDO::FETCH_NUM);

        $options = "";

        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
        foreach($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $options .= "<option value='$enregistrement[0]'>$enregistrement[1]</option>";
        }
        // Fermeture du curseur (facultatif)
        $curseur->closeCursor();
        
    }
    // Gestion des erreurs
    catch(PDOException $e) {
        $contenu = "Echec de l'exécution : " . $e->getMessage();
    }

    // Déconnexion (facultative)
    $connexion = null;
    

    // Affichage du contenu
    

?>
<form>
            Ville <select name="listeDeNoms">Choisissez votre ville
                <?php
                echo $options
                ?>
            </select>
            <input type="submit" />
        </form>
    </body>
</html>