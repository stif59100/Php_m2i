<!DOCTYPE html>
<html>
<head>
    <title>FetchAll2curseurs.php</title>
    <meta charset="UTF-8">
</head>

<body>
    <div>
        <?php
            $contenu = "";

            // Connexion
            $connexion = new PDO("mysql:host=localhost;dbname=cours", "root", "");
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexion->exec("SET NAMES 'UTF8'");

            // --- Preparation de la requete
            $curseurPays = $connexion->prepare("SELECT * FROM pays");
            // --- Execution du SELECT
            $curseurPays->execute();
            // --- Chargement de toutes les donnees
            $donneesPays = $curseurPays->fetchAll(PDO::FETCH_ASSOC);
            // --- Fermeture du curseur
            $curseurPays->closeCursor();

            // --- Boucle sur les donnees de Pays
            $curseurVilles = $connexion->prepare("SELECT * FROM villes WHERE id_pays=?");
            foreach($donneesPays as $enregistrementPays) {
                $contenu .= $enregistrementPays['nom_pays'] . "<br/>\n";
                $curseurVilles->bindParam(1, $enregistrementPays['id_pays'], PDO::PARAM_STR);
                $curseurVilles->execute();
                $donneesVilles = $curseurVilles->fetchAll(PDO::FETCH_ASSOC);
                $curseurVilles->closeCursor();
                // --- Boucle sur les donnees de Villes
                foreach($donneesVilles as $enregistrementVilles) {
                    $contenu .= "\t&nbsp;&nbsp;&nbsp;" . $enregistrementVilles['nom_ville'] . "<br/>\n";
                } /// Boucle villes
            } /// Boucle pays

            // --- Affichage
            echo $contenu;
        ?>
    </div>
</body>
</html>
