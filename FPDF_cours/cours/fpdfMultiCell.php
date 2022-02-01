<?php
	// --- fpdfMultiCell.php
	require_once("../lib/fpdf184/fpdf.php");

	$pdf = new FPDF();

	$pdf->AddPage();
	$pdf->SetFont('Courier', '', 12);
	$pdf->SetDrawColor(0, 0, 255);
	$pdf->SetFillColor(199, 199, 199);
	$pdf->SetTextColor(0, 0, 255);

	// --- Crée une cellule multi-lignes
	// --- MultiCell(largeur, hauteur, texte [, bord [, alignement [, remplissage]]])  
	$pdf->MultiCell(50, 5," Code\n Postal", 1, 'C', 1);
	$pdf->MultiCell(50, 5, "Nom du client et son prénom", 1, 'C', 1);

	$texte = utf8_decode("Pour pallier certains problèmes de Cell() il existe la méthode MultiCell().
Elle permet d'écrire sur plusieurs lignes à l'intérieur de la même cellule soit automatiquement soit avec un RC.
En revanche elle ne permet pas d'avoir deux cellules sur la même ligne.
");
	$pdf->MultiCell(0, 5, $texte, 1, '', 0);

	$pdf->Output();
?>

