<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesUpdatePrepare.php</title>
        <style>
            h1{
                font-size: 20px;
            }
        </style>
        <link rel="icon" type="image/png" href="../images/php_noir.png" />
    </head>
    <body>
        <h1>UDATE Villes</h1>
        <?php
        $message = "";
        $nomVille = "";
        $idPays = "";

        try {
            // --- Connexion ... dans tous les cas
            $connection = new PDO('mysql:host=localhost;dbname=cours', 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->exec("SET NAMES 'UTF8'");

            /*
             * Selection : affichage de la ville selectionnee dans les inputs
             * Si l'utilisateur a cliqué sur le bouton "SELECTIONNER"
             */
            $btSelectionner = filter_input(INPUT_GET, "btSelectionner");
            if ($btSelectionner != null) {
                // Le selectOne()
                $sql = "SELECT cp, nom_ville, id_pays FROM villes WHERE cp = ?";

                $cursor = $connection->prepare($sql);
                //$cp = filter_input(INPUT_GET, "lbVilles");
                $cursor->bindValue(1, filter_input(INPUT_GET, "lbVilles"));
                $cursor->execute();

                $record = $cursor->fetch();
                $nomVille = $record["nom_ville"];
                $idPays = $record["id_pays"];
            } // fin if btSelectionner

            /*
             * Modification
             * Si l'utilisateur a cliqué sur le bouton "MODIFIER"
             */
            $btModifier = filter_input(INPUT_GET, "btModifier");
            if ($btModifier != null) {
                $sql = "UPDATE villes SET nom_ville=?, id_pays=? WHERE cp=?";

                $cp = filter_input(INPUT_GET, "lbVilles");
                $nomVille = filter_input(INPUT_GET, "nomVille");
                $idPays = filter_input(INPUT_GET, "idPays");

                $statement = $connection->prepare($sql);

                $statement->bindParam(1, $nomVille); // BIND = RELIER
                $statement->bindParam(2, $idPays);
                $statement->bindParam(3, $cp);

                $statement->execute();

                //$statement->execute(array($nomVille, $idPays, $cp));

                $message = $statement->rowcount() . " enregistrement(s) modifié(s)";
            } // fin if btModifier

            /*
             * Remplissage de la liste des villes
             */
            $sql = "SELECT cp, nom_ville FROM villes ORDER BY nom_ville";
            $cursor = $connection->query($sql);

            $cp = filter_input(INPUT_GET, "lbVilles");
            $options = "";
            while ($record = $cursor->fetch()) {
                // --- Option à sélectionner
                if ($cp != null AND $record['cp'] == $cp) {
                    $options .= "<option value='$record[0]' selected='selected'>$record[1]</option>\n";
                } else {
                    $options .= "<option value='$record[0]'>$record[1]</option>\n";
                }
            }

            // --- Deconnexion
            $connection = null;
        } // fin try
        catch (PDOException $e) {
            $message = $e->getMessage();
        }
        ?>

        <form action="" method="get">
            <label>Quelle ville ? </label>
            <select name="lbVilles">
                <?php echo $options; ?>
            </select>
            <input type="submit" name="btSelectionner" value="Sélectionner"/>

            <br><br>
            <label>Ville </label>
            <input type="text" name="nomVille" value="<?php echo $nomVille; ?>" />
            <label>ID pays </label>
            <input type="text" name="idPays" value="<?php echo $idPays; ?>" size="4" />
            <input type="submit" name="btModifier" value="Modifier"/>
        </form>

        <p><?php echo $message; ?></p>

    </body>
</html>