<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<!-- BuveursBoissonPays.php -->
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BuveursBoissonPays</title>
        <style>
            table{
                border: 2px solid black;
                border-collapse: collapse;
            }
            td{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                text-align: center;
            }
            th{
                border: 2px solid black;
                border-collapse: collapse;
                padding: 5px;
                text-align: center;
            }
        </style>
    </head>

    <body>

        <h1>Les grands Buveurs</h1>
        <?php

        /**
         * 
         * @param string $host
         * @param string $port
         * @param string $db
         * @param string $user
         * @param string $pwd
         * @return PDO
         */
        function getConnexion(string $host, string $port, string $db, string $user, string $pwd): PDO {
            try {
                // Connexion
                $connexion = new PDO("mysql:host=$host;port=$port;dbname=$db;", $user, $pwd);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connexion->exec("SET NAMES 'UTF8'");
            }
            // Gestion des erreurs
            catch (PDOException $e) {
                //$tContenu = "Echec de l'exécution : " . $e->getMessage();
                $connexion = null;
            }
            return $connexion;
            /// getConnexion
        }

        /**
         * 
         * @param PDO $connexion
         * @return type
         */
        function getPays(PDO $connexion) {
            try {
                // Préparation et exécution du SELECT SQL
                $select = "SELECT nom_pays FROM pays";
                $curseur = $connexion->query($select);
                $curseur->setFetchMode(PDO::FETCH_NUM);
            }
// Gestion des erreurs
            catch (PDOException $e) {
                $contenu = "Echec de l'exécution : " . $e->getMessage();
                $curseur = null;
            }
            return $curseur;
        }

        /**
         * 
         * @param PDO $connexion
         * @return type
         */
        function getBoissons(PDO $connexion) {
            try {
                // Préparation et exécution du SELECT SQL
                $select = "SELECT designation FROM produits";
                $curseur = $connexion->query($select);
                $curseur->setFetchMode(PDO::FETCH_NUM);
            }
            // Gestion des erreurs
            catch (PDOException $e) {
                $contenu = "Echec de l'exécution : " . $e->getMessage();
                $curseur = null;
            }
            return $curseur;
        }

        /**
         * 
         * @param PDO $connexion
         * @param string $produit
         * @param string $pays
         * @return type
         */
        function getCompteBuveurs(PDO $connexion, string $produit, string $pays) {
            try {
                // Connexion
                // Préparation et exécution du SELECT SQL
                $select = "SELECT COUNT(*)  
                    FROM pays JOIN villes ON pays.id_pays=villes.id_pays
                    JOIN clients ON villes.cp=clients.cp
                    JOIN cdes ON clients.id_client = cdes.id_client
            JOIN ligcdes ON cdes.id_cde = ligcdes.id_cde
            JOIN produits ON ligcdes.id_produit = produits.id_produit
            WHERE produits.designation = '$produit' AND pays.nom_pays='$pays'";
                $curseur = $connexion->query($select);
                $curseur->setFetchMode(PDO::FETCH_NUM);
                $record = $curseur->fetch();
                $count = $record[0];
                // Fermeture du curseur (facultatif)
                //$curseur->closeCursor();
            }
            // Gestion des erreurs
            catch (PDOException $e) {
                //$contenu = "Echec de l'exécution : " . $e->getMessage();
                $t = array($e->getMessage());
                $count = -1;
            }
            return $count;
            /// getCompteBuveur
        }

        /**
         * 
         * @param PDO $connexion
         * @param string $produit
         * @param string $pays
         * @return type
         */
        function getBuveurs(PDO $connexion, string $produit, string $pays) {
            try {
                // Connexion
                // Préparation et exécution du SELECT SQL
                $select = "SELECT DISTINCT clients.nom, clients.prenom, produits.designation, pays.nom_pays 
                    FROM pays JOIN villes ON pays.id_pays=villes.id_pays
                    JOIN clients ON villes.cp=clients.cp
                    JOIN cdes ON clients.id_client = cdes.id_client
            JOIN ligcdes ON cdes.id_cde = ligcdes.id_cde
            JOIN produits ON ligcdes.id_produit = produits.id_produit
            WHERE produits.designation = '$produit' AND pays.nom_pays='$pays'";
                $curseur = $connexion->query($select);
                $curseur->setFetchMode(PDO::FETCH_NUM);
                $t = $curseur;
                // Fermeture du curseur (facultatif)
                //$curseur->closeCursor();
            }
            // Gestion des erreurs
            catch (PDOException $e) {
                //$contenu = "Echec de l'exécution : " . $e->getMessage();
                $t = array($e->getMessage());
            }
            return $t;
            /// getBuveur
        }

        /**
         * 
         * @param type $curseur
         * @return string
         */
        function displayOptions($curseur): string {
            $options = "";
            // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
            foreach ($curseur as $enregistrement) {
                // Récupération des valeurs par concaténation et interpolation
                $options .= "<option>$enregistrement[0]</option>";
            }
            return $options;
            /// displayOptions
        }

        /**
         * 
         * @param array $data
         * @return string
         */
        function displayTable($data): string {
            // ouverture tableau
            $contenu = "<table><tr><th>Nom</th><th>Prénom</th><th>Boisson</th><th>Pays</th></tr>";

            // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
            foreach ($data as $enregistrement) {
                // Récupération des valeurs par concaténation et interpolation
                $contenu .= "<tr><td>$enregistrement[0]</td><td>$enregistrement[1]</td><td>$enregistrement[2]</td><td>$enregistrement[3]</td></tr>";
            }
            //fermer le tableau
            $contenu .= "</table>";

            return $contenu;
            /// displayTable
        }

        // Connexion
        $connexion = getConnexion("127.0.0.1", "3306", "cours", "root", "");
        ?>

        <!-- Affichage des listes -->
        <form>
            <label><strong>Choisissez une boisson</strong></label>
            <br>
            <?php
            $curseur = getBoissons($connexion);
            ?>
            <select name="boisson">
                <option value="">Choisissez une boisson</option>
                <?php
                echo displayOptions($curseur);
                ?>
            </select>

            <br><br>
            <label><strong>Choisissez un pays</strong></label>
            <br>
            <?php
            $curseur = getPays($connexion);
            // Affichage du contenu
            ?>
            <select name="pays">
                <option value="">Choisissez un pays</option>
                <?php
                echo displayOptions($curseur);
                ?>
            </select>
            <p>
                <input type="submit" value="Valider" name="btValider" />
            </p>
        </form>

        <?php
        $inputProduit = filter_input(INPUT_GET, "boisson");
        $inputPays = filter_input(INPUT_GET, "pays");
        $btValider = filter_input(INPUT_GET, "btValider");

        if ($btValider != null) {
            if ($inputPays != null && $inputProduit != null) {

                $count = getCompteBuveurs($connexion, $inputProduit, $inputPays);
                if ($count == 0) {
                    $contenu = "Pas de résultats !";
                } else {
                    $t = getBuveurs($connexion, $inputProduit, $inputPays);
                    $contenu = displayTable($t);
                }
            } else {
                $contenu = "Veuillez sélectionner dans chaque liste !!!";
            }
            echo $contenu;
        }
        ?>
        <?php
        $connexion = null;
        ?>
    </body>
</html>
