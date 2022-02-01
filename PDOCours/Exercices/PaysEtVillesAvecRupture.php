<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PaysEtVillesAvecRupture.php</title>
    </head>
    <body>
        <?php

        /**
         * 
         * @param string $host
         * @param string $db
         * @param string $user
         * @param string $pwd
         * @return PDO
         */
        function getConnection(string $host, string $db, string $user, string $pwd): PDO {
            try {
                // --- Connexion ... dans tous les cas
                $connection = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->exec("SET NAMES 'UTF8'");
            } catch (PDOException $e) {
                echo $e;
                $connection = null;
            }
            return $connection;
        }

        /**
         * 
         * @param PDO $connection
         * @return array
         */
        function selectAll(PDO $connection): array {
            $sql = "SELECT p.nom_pays, v.nom_ville FROM pays p LEFT JOIN villes v ON p.id_pays = v.id_pays";
            try {
                // Exécution de la requête
                $curseur = $connection->query($sql);
                // --- Chargement de toutes les données
                $array = $curseur->fetchAll(PDO::FETCH_ASSOC);
                // --- Fermeture du curseur
                $curseur->closeCursor();
            } catch (PDOException $e) {
                echo $e->getTraceAsString();
                $array = array();
            }
            return $array;
        }

        /*
         * MAIN
         */
        $connection = getConnection("127.0.0.1", "cours", "root", "");
        $paysBefore = "";
        $array = selectAll($connection);
        $contents = "";
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]["nom_pays"] != $paysBefore) {
                $contents .= $array[$i]["nom_pays"] . "<br>";
                $paysBefore = $array[$i]["nom_pays"];
            }
            $contents .= "&nbsp;&nbsp;&nbsp;" . $array[$i]["nom_ville"] . "<br>\n";
        }
        echo $contents;
        ?>
    </body>
</html>

