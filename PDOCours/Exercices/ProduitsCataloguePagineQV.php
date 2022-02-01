<!DOCTYPE html>
<!--
ProduitsCataloguePagine.php
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Produits Catalogue Paginé</title>
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
        $sql = "SELECT * FROM produits LIMIT " . $debut . ", " . $numProduitsByPage;
        $rs = $cnx->query($sql);
        $rs->setFetchMode(PDO::FETCH_ASSOC);
        $array = $rs->fetchAll();
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Prix</th>
            </tr>
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

     $debut = filter_input(INPUT_GET, "debut");

     if ($debut == NULL) {
         $debut = 0;
     }
     //prev = debut - 5 donc on reviens en arrière
     $prev= $debut-$numProduitsByPage;
     //Si le $debut qui en résulte est = ou inférieur à 0 je passe prev à 0 comme ça on ne passe pas dans les négatifs
     if($debut <= 0 ){
         $prev = 0;
     }
    
     //retour au début avec l'url sans $debut
    echo "<a href='http://localhost:3005/cours/ProduitsCataloguePagine.php'> << Début </a>";

    echo "<a href='http://localhost:3005/cours/ProduitsCataloguePagine.php?debut=$prev'> < Précédent  </a>";

    //Boucle de pascal inchangée
    for ($i = 0; $i < $numAnchors; $i++) {
        $debut = $i * $numProduitsByPage;
        //$reference = $_SERVER['HTTP_REFERER'];
        //echo "<a href='$reference?debut=$debut'>" . ($i + 1) . "</a>" . " ";
        echo "<a href='http://localhost:3005/cours/ProduitsCataloguePagine.php?debut=$debut'>|  " . ($i + 1) . " </a>" . " ";
       
    }
    // $fin pour aller direct à la fin = nombre d'ancres -1 * le nbre de produits par page
    $fin = ($numAnchors-1)*$numProduitsByPage;
    $debut = filter_input(INPUT_GET, "debut");
   
    // si $debut est null
    if ($debut == NULL) {
        $debut = 0;
    }
    //on bloque le suivant au maximum possible
    if($debut >= $fin-$numProduitsByPage ){
        $debut = $fin-$numProduitsByPage;
    }

    $next = $debut + $numProduitsByPage;
    echo "<a href='http://localhost:3005/cours/ProduitsCataloguePagine.php?debut=$next'> Suivant > </a>";
    
    echo "<a href='http://localhost:3005/cours/ProduitsCataloguePagine.php?debut=$fin'> Fin >> </a>";
    ?>
</body>

</html>