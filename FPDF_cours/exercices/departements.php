<?php

/*
 * fpdfGrilleSurPlusieursPagesAmeliore.php
 * Répétition des entêtes sur chaque page
 * 
 * Calculer la hauteur de la page : A4 -> 21 x 29,7 donc 210 mm x 297 mm
 * Les marges standards : 1 cm donc 10 mm
 * 
 * Choix de la hauteur d'une ligne : 5 mm
 * 
 * Donc 280 / 5 
 */

require_once("../lib/fpdf17/fpdf.php");

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Courier', '', 12);

$margeHaute = 10;
$margeBasse = 10;
$hauteurLigne = 5;
$hauteurLigneExterne = $hauteurLigne + 1; // Avec les bordures
$hauteurUtileParPage = 297 - $margeHaute - $margeBasse;
$nbLignes = $hauteurUtileParPage / $hauteurLigneExterne;
$ctr = 1;

$pdf->SetDrawColor(0, 0, 255);
$pdf->SetFillColor(199, 199, 199);
$pdf->SetTextColor(0, 0, 0);

// --- Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
$pdf->Cell(30, $hauteurLigne, "CODE", 1, 0, 'C', 1);
$pdf->Cell(70, $hauteurLigne, "DEPARTEMENT", 1, 1, 'C', 1);

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // --- Si on utilise ceci il faut utiliser utf8_decode 
    // --- pour afficher plus bas les caractères accentués
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT departement_code, departement_nom FROM departement";
    $lrs = $lcn->query($lsSQL);

    foreach ($lrs as $enr) {
        // Cell(Largeur, Hauteur, Texte, [Bords, RC , Alignement, Remplissage, Lien])
        $pdf->Cell(30, $hauteurLigne, $enr[0], 1, 0, 'C', 0);
        $pdf->Cell(70, $hauteurLigne, utf8_decode($enr[1]), 1, 1, 'L', 0);
        $ctr++;
        if ($ctr % $nbLignes == 0) {
            $pdf->AddPage();
            $pdf->SetFont('Courier', '', 12);
            // --- Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
            $pdf->Cell(30, $hauteurLigne, "CODE", 1, 0, 'C', 1);
            $pdf->Cell(70, $hauteurLigne, "DEPARTEMENT", 1, 1, 'C', 1);
        }
    }
    $lrs->closeCursor();

    // --- Redirection vers le navigateur
    $pdf->Output();

    // --- Redirection vers le disque
//      $pdf->Output("../outputs/villes.pdf");
//      echo "Fichier cr&eacute;&eacute; sur le disque";
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$lcn = null;
?>