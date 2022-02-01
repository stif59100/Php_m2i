<?php

/*
 * fpdfProductCatalog.php
 */

require_once("../lib/fpdf17/fpdf.php");

define("EURO", chr(0x80));

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Courier', '', 24);

$pdf->SetXY(50, 30);
$pdf->Write(20, 'CATALOGUE PRODUITS');

// source, x, y, width, height
$pdf->Image("../images/boissons.jpg", 30, 50, 150, 80);

try {
    $lcn = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
    $lcn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Si on utilise ceci il faut utiliser utf8_decode 
    // pour afficher plus bas les caractères accentues
    $lcn->exec("SET NAMES 'UTF8'");

    $lsSQL = "SELECT id_produit, designation, prix, qte_stockee, photo FROM produits";
    $lrs = $lcn->query($lsSQL);

    foreach ($lrs as $lrecord) {
        $pdf->AddPage();
        $pdf->SetFont('Courier', '', 12);
        $pdf->SetXY(10, 5);

        $pdf->Write(10, "Code produit : ");
        $pdf->Write(10, $lrecord[0]);
        $pdf->ln();

        $pdf->Write(10, utf8_decode($lrecord[1]));
        $pdf->ln();

        //$pdf->Write(10, $lrecord[2] . utf8_decode(chr(0xC2) . chr(0x80)));
        $pdf->Write(10, number_format($lrecord[2], 2, ",", " ") . " " . EURO);
        $pdf->ln();

        $pdf->Write(10, "Stock : " . $lrecord[3] . utf8_decode(" unités"));
        $pdf->ln();

        $imageName = $lrecord[4];
        if ($imageName == null || $imageName === "") {
            $pdf->Write(10, utf8_decode("Pas d'image référencée dans la BD !!!"));
        } else {
            $lbExists = file_exists("../images/" . $imageName);
            if ($lbExists) {
                $pdf->Image("../images/" . $lrecord[4], 10, 50);
            } else {
                $pdf->Write(10, utf8_decode("L'image n'existe pas sur le serveur !!!"));
            }
        }
    }
    $lrs->closeCursor();

    // Redirection vers le navigateur
    $pdf->Output();
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$lcn = null;
?>
