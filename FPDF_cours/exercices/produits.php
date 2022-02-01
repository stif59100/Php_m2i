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

    // Calcul de la plus longue chaîne de caractères dans la colonne [designation]
    $lsSQLMaxLength = "SELECT MAX(CHAR_LENGTH(designation)) FROM produits";
    // Local Result Set = Exécute la requête SQL SELECT
    $lrs = $lcn->query($lsSQLMaxLength);
    // Extrait l'enregistrement courant
    $lrecord = $lrs->fetch();
    // Champ n° 1 de l'enregistrement
    $liLength = $lrecord[0];
    // Ferme le curseur
    $lrs->closeCursor();

    // Produit une string avec n "O"
    $string = str_repeat("O", $liLength + 2);

    // Taille de la string en mm
    $liMM = $pdf->getStringWidth($string);

    // L'ordre SQL
    $lsSQL = "SELECT designation, prix, photo FROM produits";
    // Exécute l'ordre SQL type SELECT
    $lrs = $lcn->query($lsSQL);

    // Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
    $pdf->Cell($liMM, 5, utf8_decode("Désignation"), 1, 0, 'C', 1);
    $pdf->Cell(20, 5, "Prix", 1, 1, 'C', 1);

    // Boucle sur le curseur 
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