<?php

// Personne.php

declare(strict_types = 1); // Facultatif en PHP 8

class Personne {

    // Propriétés
    private String $nom;
    private int $age;

    // Le constructeur
    public function __construct(string $nom = "", int $age = 0) {
        $this->nom = $nom;
        $this->age = $age;
    }

    // Méthodes
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getNom(): string {
        return strToUpper($this->nom);
    }

    public function setAge(int $age): void {
        $this->age = $age;
    }

    public function getAge(): int {
        return $this->age;
    }

}
?>
