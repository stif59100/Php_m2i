<?php

// Personne.php

abstract class Personne {

    // Propriétés
    private $nom;
    private $age;

    // Méthodes
    public function __construct($nom = "", $age = "") {
        $this->nom = $nom;
        $this->age = $age;
    }

//        public function __set($var, $valeur) { $this->$var = $valeur; }
//        public function __get($var) { return $this->$var; }
    public function getNom() {
        return $this->nom;
    }

    public function getAge() {
        return $this->age;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function setAge($age): void {
        $this->age = $age;
    }

}

?>
