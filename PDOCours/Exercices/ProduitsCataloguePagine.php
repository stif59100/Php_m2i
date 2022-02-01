<!DOCTYPE html>
<!--
ProduitsCataloguePagine.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produits Catalogue Paginé</title>
        <script type="text/javascript" src="https://ff.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=AlXB8xE0HM8n6ydu_faZS0h6e_AHLIGjB0irOEgEDg6W8My5Qz-yf40vve7ZiUzmWbygVzArocR3bdiRIYRgXvjmzPb-WYY5ebSna55LoePLkFVs_zMWZtYxPxJ1vmf5hhLd9DYTfUZgJivROVBfkCzJk6uYdkqz9MxAJW6gzQ_40dluNqSb74-P90a7IEjj6aUVz2923NyXTD4OPBz0XE8PvVUMKC5ix8uA6SU46Bk2ldBAkPNKqsJkHc0tt4SK6IUsceYngn46itxKEhGdmNpWVpKvKLKjOTp0nI3MptqA3nmOGMWRMDPU1HHso5J4mFTFI2T9Z4ViyhruOcZFzQ" charset="UTF-8"></script><style>
            table{
                border-collapse: collapse;
                margin: 1em;
            }
            caption, th, td{
                border: 1px solid black;
            }
            td, th{
                padding: 5px;
            }
        </style>
    </head>

    <body>
        <h1>Catalogue paginé</h1>
        <?php
        //echo $_SERVER['HTTP_REFERER'] . "<hr>";
        try {
            // CONNEXION
            $cnx = new PDO("mysql:host=localhost;dbname=cours", "root", "");
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cnx->exec("SET NAMES 'UTF8'");

            // PRODUITS PAR PAGE
            $numProduitsByPage = 5;

            // CEIL : PLAFOND; COUNT(*) : nombre total de lignes
            $sql = "SELECT CEIL(COUNT(*) / $numProduitsByPage) FROM produits";
            $rs = $cnx->query($sql);
            // RECUPERE LE 1er ET UNIQUE ENREGISTREMENT DU CURSEUR
            $cursor = $rs->fetch();
            // 1er et UNIQUE CHAMP DE L'ENREGISTREMENT 
            $numAnchors = $cursor[0];

            // OBLIGATOIRE
            $rs->closeCursor();

            // RECUPERE L'ATTRIBUT D'URL SUITE A UNE REQUETE GET D'UNE ANCRE
            $debut = filter_input(INPUT_GET, "debut");
            // LA PREMIERE REQUETE EST SANS PARAMETRE
            // $debut est 
            if ($debut == NULL) {
                $debut = 0;
            }
            // LIMIT offset, ROWS_COUNT
            $sql = "SELECT * FROM produits LIMIT " . $debut . ", $numProduitsByPage";
            $rs = $cnx->query($sql);
            $rs->setFetchMode(PDO::FETCH_ASSOC);
            $array = $rs->fetchAll();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        ?>

        <table>
            <thead>
                <tr><th>Désignation</th><th>Prix</th></tr>
            </thead>

            <tbody>
                <?php
                foreach ($array as $line) {
                    echo "<tr><td>" . $line["designation"] . "</td><td>" . $line["prix"] . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <hr>
        <?php
        echo "Page n° " . (($debut / $numProduitsByPage) + 1);
        ?>
        <hr>
        <?php
        $url = "http://";
        $url .= $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/" . $_SERVER['SCRIPT_NAME'];
        // PRODUCTION DES ANCRES
        for ($i = 0; $i < $numAnchors; $i++) {
            $debut = $i * $numProduitsByPage;
            //$reference = $_SERVER['HTTP_REFERER'];
            //echo "<a href='$reference?debut=$debut'>" . ($i + 1) . "</a>" . " ";

            //echo "<a href='http://localhost/PDOCours/exercices/ProduitsCataloguePagine.php?debut=$debut'>" . ($i + 1) . "</a>" . " ";
            echo "<a href='$url?debut=$debut'>" . ($i + 1) . "</a>" . " ";
        }


//        echo "<br>" . $_SERVER['SERVER_PROTOCOL'];
//        echo "<br>" . $_SERVER['SERVER_NAME'];
//        echo "<br>" . $_SERVER['SCRIPT_NAME'];
//        echo "<br>" . $_SERVER['HTTP_REFERER'];


        echo "<br>" . $url;
        ?>
    </body>
</html>
