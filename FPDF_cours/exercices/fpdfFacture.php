<?php

/*
  DELIMITER $$

  DROP PROCEDURE IF EXISTS `cours`.`commandes_un_client` $$
  CREATE PROCEDURE `cours`.`commandes_un_client` (aiIdClient INT)
  BEGIN

  SELECT v.cp, v.nom_ville, c.id_client, c.nom, c.prenom, c.adresse, cd.id_cde, cd.date_cde
  FROM villes v INNER JOIN clients c
  ON v.cp = c.cp
  INNER JOIN cdes cd
  ON c.id_client = cd.id_client
  WHERE c.id_client = aiIdClient;

  END $$

  DELIMITER ;
 */

/*
  DELIMITER $$

  DROP PROCEDURE IF EXISTS `cours`.`lignes_commandes_une_commande` $$
  CREATE PROCEDURE `cours`.`lignes_commandes_une_commande` (aiIdCommande INT)
  BEGIN
  SELECT p.id_produit, p.designation, p.prix, l.qte AS 'Quantite', p.prix * l.qte AS 'Montant'
  FROM ligcdes l INNER JOIN produits p
  ON l.id_produit = p.id_produit
  WHERE l.id_cde = aiIdCommande;
  END $$

  DELIMITER ;
 */

/*
  DELIMITER $$

  DROP PROCEDURE IF EXISTS `cours`.`total_une_commande` $$
  CREATE PROCEDURE `cours`.`total_une_commande` (aiIdCommande INT)
  BEGIN
  SELECT SUM(l.qte * p.prix) AS Total
  FROM ligcdes l INNER JOIN produits p
  ON l.id_produit = p.id_produit
  WHERE l.id_cde = aiIdCommande;
  END $$

  DELIMITER ;
 */
// fpdfFacture.php
require_once("../lib/fpdf17/fpdf.php");

define("EURO", chr(0x80));

$tMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

$pdf = new FPDF();
$liNumCommande = 2;

try {
    /*
     * CONNEXION A LA BD
     */
    $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Si on utilise ceci il faut utiliser utf8_decode 
    // pour afficher plus bas les caractères accentues
    $lcn->exec("SET NAMES 'UTF8'");

    /*
     * L'APPEL A LA PS POUR L'ENTETE DE LA COMMANDE
     */
    $lsSQL = "CALL commandes_un_client(?)";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->bindValue(1, $liNumCommande);
    $lrs->execute();
    $record = $lrs->fetch();

    $cp = "";
    $nomVille = "";
    $idClient = "";
    $prenom = "";
    $nom = "";
    $adresse = "";
    $idFacture = "";
    $dateFacture = "";
    if ($record !== FALSE) {
        $cp = $record[0];
        $nomVille = $record[1];

        $idClient = $record[2];
        $nom = $record[3];
        $prenom = $record[4];
        $adresse = $record[5];

        $idFacture = $record[6];
        $dateFacture = $record[7];
    }

    $lrs->closeCursor();


    /*
     * LA PAGE
     */

    $pdf->AddPage();
    $pdf->SetFont('Courier', '', 10);

    $liHauteurLigne = 7;

    /*
     * L'ENTETE DE LA COMMANDE
     */

    // Numero de Facture et date
    $x = 10;
    $y = 10;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("N° facture : " . $idFacture));

    $x += 100;
    $pdf->SetXY($x, $y);
    $tDate = explode("-", $dateFacture);
    $pdf->write($liHauteurLigne, utf8_decode("Date : " . $tDate[2] . " " . $tMois[$tDate[1] - 1] . " " . $tDate[0]));

    // Le client
    $x = 10;
    $y += 7;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("N° client : " . $idClient));


    $y += 7;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("Nom : " . $nom));

    $x += 50;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("Prénom : " . $prenom));

    $x = 10;
    $y += 7;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("Adresse : " . $adresse));

    $y += 7;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("CP : " . $cp));

    $x += 50;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("Ville : " . $nomVille));

    // Les produits
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFillColor(199);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->ln(20);

    // En-tete : Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
    $pdf->Cell(25, 7, utf8_decode("ID produit"), 1, 0, 'C', 1);
    $pdf->Cell(70, 7, utf8_decode("Désignation"), 1, 0, 'C', 1);
    $pdf->Cell(20, 7, utf8_decode("Prix"), 1, 0, 'C', 1);
    $pdf->Cell(20, 7, utf8_decode("Quantité"), 1, 0, 'C', 1);
    $pdf->Cell(30, 7, utf8_decode("Montant"), 1, 1, 'C', 1);


    /*
     * LES LIGNES DE COMMANDE
     */
    /*
     * L'APPEL A LA PS POUR LES LIGNES DE LA COMMANDE
     */
    $lsSQL = "CALL lignes_commandes_une_commande(?)";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->bindValue(1, $liNumCommande);
    $lrs->execute();


    /*
     * LES LIGNES DE COMMANDE
     */
    $total = 0;
    while ($record = $lrs->fetch()) {
        // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
        $pdf->Cell(25, 7, utf8_decode($record[0]), 1, 0, 'C', 0);
        $pdf->Cell(70, 7, utf8_decode($record[1]), 1, 0, 'C', 0);
        $pdf->Cell(20, 7, number_format($record[2], 2, ",", " "), 1, 0, 'C', 0);
        $pdf->Cell(20, 7, utf8_decode($record[3]), 1, 0, 'C', 0);
        $pdf->Cell(30, 7, number_format($record[4], 2, ",", " "), 1, 1, 'C', 0);
        $total += $record[4];
    }

    /*
     * LE TOTAL
     */
    $pdf->Cell(25, 7, "", 0, 0, 'C', 0);
    $pdf->Cell(70, 7, "", 0, 0, 'C', 0);
    $pdf->Cell(20, 7, "", 0, 0, 'C', 0);
    $pdf->Cell(20, 7, utf8_decode("Total"), 1, 0, 'C', 1);
    $pdf->Cell(30, 7, number_format($total, 2, ",", " ") . " " . EURO, 1, 1, 'C', 0);

    $lrs->closeCursor();

    /*
     * LE TOTAL
     */
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

//$pdf->Output("../outputs/FactureModele.pdf");
$pdf->Output();

$lcn = null;
?>