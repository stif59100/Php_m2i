<?php

class Pays {

    // --- Proprietes
    public $idPays;
    public $nomPays;

    // --- Methodes
    function __construct($idPays, $nomPays) {
        $this->idPays = $idPays;
        $this->nomPays = $nomPays;
    }

    public function getIdPays() {
        return $this->idPays;
    }

    public function getNomPays() {
        return $this->nomPays;
    }

    public function setIdPays($idPays) {
        $this->idPays = $idPays;
    }

    public function setNomPays($nomPays) {
        $this->nomPays = $nomPays;
    }

}

?>