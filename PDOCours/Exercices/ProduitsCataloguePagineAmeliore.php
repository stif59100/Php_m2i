<!DOCTYPE html>
<!--
ProduitsCataloguePagineAmeliore.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produits Catalogue Paginé Amélioré</title>
        <style>
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
            a{
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <h1>Catalogue paginé amélioré</h1>
        <?php
        try {
            // CONNEXION
            $cnx = new PDO("mysql:host=localhost;dbname=cours", "root", "");
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cnx->exec("SET NAMES 'UTF8'");

            // PARAMETRAGE NOMBRE DE PRODUITS PAR PAGE
            $numProduitsByPage = 5;

            // CALCUL DU NOMBRE TOTAL DE PAGE
            $sql = "SELECT CEIL(COUNT(*) / $numProduitsByPage) FROM produits";
            $rs = $cnx->query($sql);
            $cursor = $rs->fetch();
            $numAnchors = $cursor[0];
            //$lastIndex = $numAnchors - 1;

            $rs->closeCursor();

            // RECUPERATION DE LA VALEUR DE DEBUT DANS l'ATTRIBUT d'URL
            $currentPage = filter_input(INPUT_GET, "currentPage");
            if ($currentPage == NULL) {
                $currentPage = 1;
            } else {
                
            }
            // RECUPERATION DES N PRODUITS
            $offset = ($currentPage - 1) * $numProduitsByPage;
            $sql = "SELECT * FROM produits LIMIT " . $offset . ", $numProduitsByPage";
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
                // LES PRODUITS
                foreach ($array as $line) {
                    echo "<tr><td>" . $line["designation"] . "</td><td>" . $line["prix"] . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <hr>
        <?php
        echo "Page n° " . $currentPage;
        ?>
        <hr>
        <?php
        $url = "http://";
        $url .= $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/" . $_SERVER['SCRIPT_NAME'];

        /*
         *  LES ANCRES
         */
        // LES ANCRES FIRST AND PREVIOUS
        echo "<a href='$url?currentPage=1'>Premier&nbsp;&nbsp;&nbsp;</a>" . " ";

        if ($currentPage == 1) {
            $previous = $numAnchors;
        } else {
            $previous = $currentPage - 1;
        }
        echo "<a href='$url?currentPage=$previous'>Précédent&nbsp;&nbsp;</a>" . " ";

        // LES ANCRES NUMEROTEES
        for ($i = 0; $i < $numAnchors; $i++) {
            $debut = $i + 1;
            //$reference = $_SERVER['HTTP_REFERER'];
            //echo "<a href='$reference?debut=$debut'>" . ($i + 1) . "</a>" . " ";
            echo "<a href='$url?currentPage=$debut'>" . ($i + 1) . "</a>" . " ";
        }
        // LES ANCRES NEXT AND LAST
        $next = $currentPage + 1;
        if ($currentPage == $numAnchors) {
            $next = 1;
        }
        echo "<a href='$url?currentPage=$next'>&nbsp;&nbsp;&nbsp;Suivant</a>" . " ";
        // 
        $last = $numAnchors;
        echo "<a href='$url?currentPage=$last'>&nbsp;&nbsp;&nbsp;Dernier</a>" . " ";
        ?>
    </body>
</html>
