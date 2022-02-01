<?php

/**
 * Description of Pays
 *
 * @author Pascal
 */
declare(strict_types = 1);

class Pays {

    private $idPays;
    private $nomPays;

    public function __construct(string $idPays = "", string $nomPays = "") {
        $this->idPays = $idPays;
        $this->nomPays = $nomPays;
    }

    public function getIdPays(): string {
        return $this->idPays;
    }

    public function getNomPays(): string {
        return $this->nomPays;
    }

    public function setIdPays(string $idPays): void {
        $this->idPays = $idPays;
    }

    public function setNomPays(string $nomPays): void {
        $this->nomPays = $nomPays;
    }

}