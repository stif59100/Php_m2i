<?php

/**
 * Description of Stagiaire
 *
 * @author kalan
 */
require_once("Personne.php");

class Stagiaire extends Personne {

    //put your code here
    private $diplome;

    public function __construct($nom = "", $age = "", $diplome="") {
        parent::__construct($nom, $age);
        $this->diplome = $diplome;
    }

    public function getDiplome() {
        return $this->diplome;
    }

    public function setDiplome($diplome): void {
        $this->diplome = $diplome;
    }

}
