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
            
            $idsSelect = str_replace("#",",", $oldCookie);
        
        // s'il y'a un # dans le cookie
       
            //on enlève les # et on en fait un array
            
            // je crée l'ordre SQL de base
            $sql = "SELECT * FROM produits WHERE id_produit IN($idsSelect)";
        
            
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