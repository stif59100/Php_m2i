<?php

/*
 * LE DTO DE LA TABLE [produits] DE LA BD [cours] (PHP 8)
 */

declare(strict_types=1);

class Produits {

    // ATTRIBUTS
    private int $idProduit;
    private string $designation;
    private float $prix;
    private int $qteStockee;
    private string $photo;
    private string $categorie;

    // CONSTRUCTEUR
    function __construct($designation = "", $prix = 0, $qteStockee = 0, $photo = "", $categorie = "", $idProduit = 0) {
        $this->idProduit = $idProduit;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->qteStockee = $qteStockee;
        if ($photo == NULL) {
            $this->photo = "";
        } else {
            $this->photo = $photo;
        }
//        $this->photo = $photo;
        if ($categorie == NULL) {
            $this->categorie = "Absente";
        } else {
            $this->categorie = $categorie;
        }
//        $this->categorie = $categorie;
    }

    // GETTERS AND SETTERS
    public function setIdProduit(int $idProduit): void {
        $this->idProduit = $idProduit;
    }

    public function setDesignation(string $designation): void {
        $this->designation = $designation;
    }

    public function setPrix(float $prix): void {
        $this->prix = $prix;
    }

    public function setQteStockee(int $qteStockee): void {
        $this->qteStockee = $qteStockee;
    }

    public function setPhoto(string $photo): void {
//        $this->photo = $photo;
        if ($photo == NULL) {
            $this->photo = "Absente";
        } else {
            $this->photo = $photo;
        }
    }

    public function setCategorie(string $categorie): void {
        $this->categorie = $categorie;
    }

    public function getIdProduit(): int {
        return $this->idProduit;
    }

    public function getDesignation(): string {
        return $this->designation;
    }

    public function getPrix(): float {
        return $this->prix;
    }

    public function getQteStockee(): int {
        return $this->qteStockee;
    }

    public function getPhoto(): string {
        return $this->photo;
    }

    public function getCategorie(): string {
        return $this->categorie;
    }

}

// / class Produits
?>
