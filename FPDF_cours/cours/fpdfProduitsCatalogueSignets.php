<?php
   // --- fpdfProduitsCatalogueSignets.php
   // --- Le catalogue

   require_once("PDF_Bookmark.php");

   $pdf = new PDF_Bookmark();
   $pdf->SetFont('Courier','',10);

   try {
      $pdo = new PDO("mysql:host=localhost;dbname=cours;port=3306", "root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->exec("SET NAMES 'UTF8'");

      $sql = "SELECT * FROM produits";
      $curseur = $pdo->prepare($sql);
      $curseur->execute();
      $curseur->setFetchMode(PDO::FETCH_ASSOC);

      $cheminPhotos = "../images/";

      foreach($curseur as $enregistrement) {
         $pdf->AddPage();

         $pdf->Bookmark(utf8_decode($enregistrement["designation"]));

         $pdf->write(10, "ID : " . $enregistrement["id_produit"]);
         $pdf->ln();

         $pdf->write(10, utf8_decode("Désignation : " . $enregistrement["designation"]));
         $pdf->ln();

         $prix = $enregistrement["prix"];
         $prix = str_replace(".", ",", $prix);
         $pdf->write(10, "Prix : " .  $prix . utf8_decode(" " . chr(0xC2) . chr(0x80)));
         $pdf->ln();

         $pdf->write(10, "Stock : " . $enregistrement["qte_stockee"]);
         $pdf->ln();

         $photo = $enregistrement["photo"];
         if($photo != "") {
            if(file_exists($cheminPhotos . $photo)) {
                // photo[, x, y]
                $pdf->Image($cheminPhotos . $photo, 10, 55);
            }
            else $pdf->write(10, "Pas de photo disponible");
         }
         else $pdf->write(10, "Pas de photo disponible");
      }
   }

   catch(PDOException $e) {
         echo "Echec de l'exécution : " . $e->getMessage();
   }
   $pdo = null;
   $pdf->Output();
   $pdf->Output("../outputs/Catalogue.pdf");
?>

