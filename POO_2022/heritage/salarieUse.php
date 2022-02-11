<?php
    header("Content-Type: text/html;charset=UTF-8");

    require_once("Salarie.php");
    require_once("Stagiaire.php");
    
    require_once("./StagiaireDeProvince.php");


    // Instanciation d'un objet et utilisation
    $tintin = new Salarie("Tintin", 30);
    //echo "$tintin->nom a $tintin->age ans";
    echo $tintin->getNom() . " a " . $tintin->getAge() . " ans";

    $haddock = new Salarie("Haddock", 50, 3000);
    echo "<br>" . $haddock->getNom() . " a " . $haddock->getAge() . " ans et a un salaire de " . $haddock->getSalaire() . " euros";
    //echo "<br>Le salarié $haddock->nom est âgé de $haddock->age ans et gagne $haddock->salaire euros";

    $amelie = new Stagiaire("Amélie", 75, "DW");
    echo "<br>" . $amelie->getNom() . " a " . $amelie->getAge() . " ans et a un diplôme de " . $amelie->getDiplome();
    
    
    $quentin = new StagiaireDeProvince();
    
    ?>