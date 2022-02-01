<!DOCTYPE html>
<!--
panier.php
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 1em;
        }

        caption,
        th,
        td {
            border: 1px solid black;
        }

        td,
        th {
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Panier</h1>

    <?php
    $array=null;
    // si le cookie n'existe pas
    if (!isset($_COOKIE["panier"])) {
        
    } else {
        //si le cookie existe
        if (isset($_COOKIE["panier"])) {

            $oldCookie = $_COOKIE["panier"];
            //on coupe le cookie tous les #
            $diese = explode("#", $oldCookie);
        }
        // s'il y'a un # dans le cookie
        if ($diese = true) {
            //on enlève les # et on en fait un array
            $oldDecode = explode('#', $oldCookie);
            // je crée l'ordre SQL de base
            $sql = "SELECT * FROM produits WHERE id_produit =";
            //boucle sur toutes les valeurs du cookie sur la longueur -1
            for ($c = 0; $c <= count($oldDecode) - 1; $c++) {
                //si $c = à la longeur du cookie explosé
                if ($c == count($oldDecode) - 1) {
                    //on passe la dernière valeur de l'ordre sQL (sans le OR)
                    $sql .= $oldDecode[$c];
                } else {
                    //sinon on ajoute le $c actuel avec le OR pour continuer l'ordre
                    $sql .= $oldDecode[$c] . " OR id_produit=";
                }
            }
        } else {
            //si un seul produit dans le cookie (donc pas de #)
            $sql = "SELECT * FROM produits WHERE id_produit = $oldCookie[0]";
        }
        try {
            // CONNEXION
            $cnx = new PDO("mysql:host=localhost;dbname=cours", "root", "");
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cnx->exec("SET NAMES 'UTF8'");
            $rs = $cnx->query($sql);
            $rs->setFetchMode(PDO::FETCH_ASSOC);
            $array = $rs->fetchAll();

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }


    ?>


</body>
<table>
    <thead>
        <tr>
            <th>Désignation</th>
            <th>Prix</th>

        </tr>
    </thead>

    <tbody>
        <?php
        if ($array != null) {
            foreach ($array as $line) {
                echo "<tr><td>" . $line["designation"] . "</td><td>" . $line["prix"] . "</td></tr>";
            }
        }else{
            echo"Panier VIDE";
        }
        ?>
    </tbody>
</table>
<hr>

</html>