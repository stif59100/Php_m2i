<!DOCTYPE html>
<!--
ProduitsCataloguePaginePourAjoutAuPanier.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produits Catalogue Paginé</title>
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
                <tr><th>Désignation</th><th>Prix</th><th>Ajout au panier</th></tr>
            </thead>

            <tbody>
                <?php
                foreach ($array as $line) {
                    echo "<tr><td>" . $line["designation"] . "</td><td>" . $line["prix"] . "</td><td><a href='http://localhost/PDOcours/cart/ajoutAuPanier.php?id_produit=". $line["id_produit"] . "'>" . "<img src='../images/boissons.jpg' alt='Panier' width='50' title='Produit xxx au panier' />" . "</a></td></tr>";
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
