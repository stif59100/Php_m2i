<?php

// fpdfGridFromDBAdvanced.php
require_once("../lib/fpdf17/fpdf.php");

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Courier', '', 12);

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(199, 199, 199);
$pdf->SetTextColor(0, 0, 0);

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Si on utilise ceci il faut utiliser utf8_decode 
    // pour afficher plus bas les caractères accentues
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQLMaxLength = "SELECT MAX(LENGTH(designation)) FROM produits;";
    $lrs = $lcn->query($lsSQLMaxLength);
    $lrecord = $lrs->fetch();
    $liLength = $lrecord[0];
    $lrs->closeCursor();

    $string = str_pad("O", $liLength);

    $liMM = $pdf->getStringWidth($string);

    $lsSQL = "SELECT designation, prix, photo FROM produits";
    $lrs = $lcn->query($lsSQL);

    // Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
    $pdf->Cell($liMM, 5, utf8_decode("Désignation"), 1, 0, 'C', 1);
    $pdf->Cell(20, 5, "Prix", 1, 1, 'C', 1);

    foreach ($lrs as $lrecord) {
        // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
        $pdf->Cell($liMM, 5, utf8_decode($lrecord[0]), 1, 0, 'C', 0);
        $pdf->Cell(20, 5, $lrecord[1], 1, 1, 'L', 0);
    }
    $lrs->closeCursor();

    // Redirection vers le navigateur
    $pdf->Output();

    // Redirection vers le disque
//      $pdf->Output("../outputs/villes.pdf");
//      echo "Fichier cr&eacute;&eacute; sur le disque";
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$lcn = null;
?>