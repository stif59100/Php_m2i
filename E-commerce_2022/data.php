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
            $currentPage = filter_input(INPUT_GET, "page");
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