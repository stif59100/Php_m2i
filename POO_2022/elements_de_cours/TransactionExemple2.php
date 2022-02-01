<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TransactionExemple2.php</title>
    </head>
    <body>

        <?php
        $message = "";
        $btValider = filter_input(INPUT_GET, "btValider");

        if ($btValider != null) {

            $idClient = filter_input(INPUT_GET, "idClient");
            $idProduit = filter_input(INPUT_GET, "idProduit");

            try {
                /*
                 * CNX
                 */
                $connection = new PDO("mysql:host=localhost;dbname=cours", "root", "");
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$connection->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
                $connection->exec("SET NAMES 'UTF8'");

                /*
                 * BEGIN TX
                 */
                $connection->beginTransaction();

                /*
                 * INSERTS
                 */
                /*
                 * CDES
                 */
                $sql = "INSERT INTO cdes(date_cde, id_client) VALUES(?,?)";
                $statement = $connection->prepare($sql);
                $date = date("Y-m-d");
                $statement->execute(array($date, $idClient)); // Alternative
                $message = $statement->rowcount() . " commande(s) ajoutée(s)";
                /*
                 * LIGCDES
                 */
                $sql = "INSERT INTO ligcdes(id_cde, id_produit, qte) VALUES(?,?,?)";
                $statement = $connection->prepare($sql);
                $idCde = $connection->lastInsertId();
                $statement->execute(array($idCde, $idProduit, 10)); // Alternative
                $message .= "<br>" . $statement->rowcount() . " ligne(s) ajoutée(s)";
                
                /*
                 * FIN TXT
                 */
                $connection->commit();
            } catch (PDOException $e) {
                $message = $e->getMessage();
                $connection->rollback();
            }
            $connection = null;
        } else {
            $message = "Toutes les saisies sont obligatoires !!!";
        }
        ?>

        <form action="" method="get">
            <label>ID Client </label>
            <input type="text" name="idClient" value="1" size="5" />
            <label>ID Produit </label>
            <input type="text" name="idProduit" value="1" size="4" />

            <input type="submit" name="btValider"/>
        </form>

        <label>
            <?php echo $message; ?>
        </label>

    </body>
</html>

