<?php
    // --- VillesSelect.php
    header("Content-Type: text/html; charset=UTF-8");

    try {
        // Connexion
        $connexion = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES 'UTF8'");

        // Préparation et exécution du SELECT SQL
        $select = "SELECT cp, nom_ville, site, photo  FROM villes";
        $curseur = $connexion->query($select);
        $curseur->setFetchMode(PDO::FETCH_NUM);

        $contenu = "<table border='1'><tr><th>Cp</th><th>Villes</th>
        <th>Lien</th><th>Photo</th>
</tr>";

        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
        foreach($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $image .= '../images/pasdephoto.png';
            $contenu .= "
            <tr><td>$enregistrement[0]</td><td>$enregistrement[1]</td><td><a href='https://$enregistrement[2]' target='_blank'>$enregistrement[2]</a></td><td><img alt='$enregistrement[1]' src='../images/$enregistrement[3]' width='200'></td></tr>";
        }
        // Fermeture du curseur (facultatif)
        $curseur->closeCursor();
        $contenu .="</table>";
    }
    // Gestion des erreurs
    catch(PDOException $e) {
        $contenu = "Echec de l'exécution : " . $e->getMessage();
    }

    // Déconnexion (facultative)
    $connexion = null;

    // Affichage du contenu
    echo $contenu;
