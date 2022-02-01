<!DOCTYPE html>
<!--
InsertIntoClientsWithFK.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>InsertIntoClientsWithFK</title>
        <style>
            p {margin: 0; padding:3px;}
        </style>
    </head>

    <body>
        <?php
        $message = "";
        $options = "";

        try {
            // --- Tentative de connexion
            $connexion = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
            // --- Attributs de connexion : erreur --> exception
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // --- Communication UTF-8 entre BD et script
            $connexion->exec("SET NAMES 'UTF8'");

            $cursor = $connexion->query("SELECT cp, nom_ville FROM villes ORDER BY nom_ville");
            $cursor->setFetchMode(PDO::FETCH_NUM);

            // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
            foreach ($cursor as $record) {
                // Récupération des valeurs par concaténation et interpolation
                $options .= "<option value='$record[0]'>$record[1]</option>";
            }
            // Fermeture du curseur (facultatif)
            $cursor->closeCursor();

            $btInsert = filter_input(INPUT_POST, "btInsert");
            if ($btInsert != null) {
                $nom = filter_input(INPUT_POST, "nom");
                $cp = filter_input(INPUT_POST, "cp");
                $sql = "INSERT INTO clients(nom, cp) VALUES(?,?)";

                $statement = $connexion->prepare($sql);
                $statement->bindValue(1, $nom);
                $statement->bindValue(2, $cp);
                $statement->execute();

                $message = $statement->rowCount() . " enregistrement ajouté";
            }
        } catch (Exception $exc) {
            //$message = $exc->getTraceAsString();
            $message = $exc->getMessage();
        }
        ?>

        <form action="" method="POST">
            <p>Nom ? </p>
            <p>
                <input type="text" name="nom" value="Tintin" />
            </p>
            <p>Ville ? </p>
            <p>
                <select name="cp">
                    <?php
                    echo $options;
                    ?>
                </select>
            </p>
            <p>
                <input type="submit" value="Insert" name="btInsert" />
            </p>
        </form>

        <p>
            <?php
            echo $message;
            ?>
        </p>

    </body>
</html>