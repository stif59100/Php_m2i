<!DOCTYPE html>
<html>
    <head>
        <title>JoinPaysVilles.php</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <?php
        $contenu = "";

        // Connexion
        $connexion = new PDO("mysql:host=localhost;dbname=cours", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        // Exécution de la requête
        $curseur = $connexion->query("SELECT p.nom_pays, v.nom_ville FROM pays p LEFT JOIN villes v ON p.id_pays = v.id_pays");
        // --- Chargement de toutes les données
        $enregistrements = $curseur->fetchAll(PDO::FETCH_ASSOC);
        // --- Fermeture du curseur
        $curseur->closeCursor();

        // --- Boucle sur les données de Pays
        foreach ($enregistrements as $enregistrement) {
            $contenu .= $enregistrement['nom_pays'] . "-" . $enregistrement['nom_ville'] . "<br/>\n";
        } /// Boucle pays
        ?>

        <div>
            <?php
            // --- Affichage
            echo $contenu;
            ?>
        </div>
    </body>
</html>