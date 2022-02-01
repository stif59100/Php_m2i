<?php

require_once("../lib/fpdf17/fpdf.php");

define("EURO", chr(0x80));



$pdf = new FPDF();
$numeroCommande = 110;

try {

    $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Si on utilise ceci il faut utiliser utf8_decode 
    // pour afficher plus bas les caractères accentues
    $lcn->exec("SET NAMES 'UTF8'");

    
    $lsSQL = "SELECT c.cp, v.nom_ville, cd.id_client, c.nom, c.prenom, c.adresse, cd.id_cde, DATE_FORMAT(cd.date_cde, '%d %M %Y') date_cde FROM villes v  NATURAL JOIN clients c NATURAL JOIN cdes cd WHERE cd.id_cde = ?";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->bindValue(1, $numeroCommande);
    $lrs->execute();
    $record = $lrs->fetch(PDO::FETCH_ASSOC);

    $cp = "";
    $nomVille = "";
    $idClient = "";
    $prenom = "";
    $nom = "";
    $adresse = "";
    $idFacture = "";
    $dateFacture = "";
    if ($record !== FALSE) {
        $cp = $record['cp'];
        $nomVille = $record['nom_ville'];

        $idClient = $record['id_client'];
        $nom = $record['nom'];
        $prenom = $record['prenom'];
        $adresse = $record['adresse'];

        $idFacture = $record['id_cde'];
        $dateFacture = $record['date_cde'];
    }

    $lrs->closeCursor();


   

    $pdf->AddPage();
    $pdf->SetFont('Courier', '', 10);

    $liHauteurLigne = 7;

    
    // Numero de Facture et date
    $x = 10;
    $y = 10;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("N° facture : " . $idFacture));

    $x += 100;
    $pdf->SetXY($x, $y);
    $pdf->write($liHauteurLigne, utf8_decode("Date : " . $dateFacture));

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


    
    $lsSQL = "SELECT p.id_produit, p.designation, p.prix, l.qte AS 'Quantite', p.prix * l.qte AS 'Montant' FROM ligcdes l NATURAL JOIN produits p WHERE l.id_cde = ?";
    $lrs = $lcn->prepare($lsSQL);
    $lrs->bindValue(1, $numeroCommande);
    $lrs->execute();


    
    $total = 0;
    while ($record = $lrs->fetch(PDO::FETCH_ASSOC)) {
        // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
        $pdf->Cell(25, 7, utf8_decode($record['id_produit']), 1, 0, 'C', 0);
        $pdf->Cell(70, 7, utf8_decode($record['designation']), 1, 0, 'C', 0);
        $pdf->Cell(20, 7, number_format($record['prix'], 2, ",", " "), 1, 0, 'C', 0);
        $pdf->Cell(20, 7, utf8_decode($record['Quantite']), 1, 0, 'C', 0);
        $pdf->Cell(30, 7, number_format($record['Montant'], 2, ",", " "), 1, 1, 'C', 0);
        $total += $record['Montant'];
    }

    
    $pdf->Cell(25, 7, "", 0, 0, 'C', 0);
    $pdf->Cell(70, 7, "", 0, 0, 'C', 0);
    $pdf->Cell(20, 7, "", 0, 0, 'C', 0);
    $pdf->Cell(20, 7, utf8_decode("Total"), 1, 0, 'C', 1);
    $pdf->Cell(30, 7, number_format($total, 2, ",", " ") . " " . EURO, 1, 1, 'C', 0);

    $lrs->closeCursor();

    
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}


$pdf->Output();

$lcn = null;