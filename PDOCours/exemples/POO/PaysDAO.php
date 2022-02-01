<?php

/*
 * PaysDAO.php
 */

declare(strict_types = 1);

require_once '../entities/Pays.php';

class PaysDAO {

    private $pdo;

    function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param Pays $pays
     * @return int
     */
    public function insert(Pays $pays): int {
        // Création var pour la sortie, le retour de la fct 
        $affected = 0;

        // On va essayer d'exécuter le code qui suit, qui est entre {} avant le catch
        try {
            // On compile l'ordre SQL
            $lcmd = $this->pdo->prepare("INSERT INTO pays(id_pays, nom_pays) VALUES(?,?)");
            // On associe des valeurs aux paramètres de la requete, ie les attributs de l'objet reçus en param
            // Pour le param 1, l'id pays
            $lcmd->bindValue(1, $pays->getIdPays());
            $lcmd->bindValue(2, $pays->getNomPays());
            // On exécute l'ordre SQL
            $lcmd->execute();
            // On compte le nb de ligne insérées
            $affected = $lcmd->rowCount();
            // Si une erreur survient
        } catch (PDOException $exc) {
            // En période de dev
            echo $exc->getMessage();
            // Code conventionel en cas d'erreur
            $affected = -1;
        }

        // Retour de la fct (output)
        return $affected;
    }

    /**
     *
     * @param Pays $pays
     * @return int
     */
    public function delete(Pays $pays): int {
        $affected = 0;

        try {
            $lcmd = $this->pdo->prepare("DELETE FROM pays WHERE id_pays = ?");
            $lcmd->bindValue(1, $pays->getIdPays());
            $lcmd->execute();
            $affected = $lcmd->rowCount();
        } catch (Exception $exc) {
            echo $exc->getMessage();
            $affected = -1;
        }
        return $affected;
    }

    /**
     *
     * @param Pays $pays
     * @return int
     */
    public function update(Pays $pays): int {
        $affected = 0;

        try {
            $lcmd = $this->pdo->prepare("UPDATE pays SET nom_pays = ? WHERE id_pays = ?");
            $lcmd->bindValue(1, $pays->getNomPays());
            $lcmd->bindValue(2, $pays->getIdPays());
            $lcmd->execute();
            $affected = $lcmd->rowCount();
        } catch (Exception $exc) {
            echo $exc->getMessage();
            $affected = -1;
        }
        return $affected;
    }

    /**
     * 
     * @param type $pk
     * @return \Pays
     */
    public function selectOne($pk) {

        try {
            $lrs = $this->pdo->prepare("SELECT * FROM pays WHERE id_pays = ?");
            $lrs->bindParam(1, $pk);
            $lrs->execute();
            $record = $lrs->fetch();
            if ($record != null) {
                //echo "<br>" . $record[0];
                $pays = new Pays($record[0], $record[1]);
            } else {
                $pays = new Pays("0", "Introuvable");
            }
            $lrs->closeCursor();
        } catch (Exception $exc) {
            echo $exc->getMessage();
            $pays = new Pays("-1", $exc->getMessage());
        }
        return $pays;
    }

    /**
     *
     * @return array
     */
    public function selectAll(): array {

//        $tPays = array();
//        try {
//            $lrs = $this->pdo->query("SELECT * FROM pays");
//            $lrs->setFetchMode(PDO::FETCH_ASSOC);
//            while ($record = $lrs->fetch()) {
//                $pays = new Pays($record["id_pays"], $record["nom_pays"]);
//                $tPays[] = $pays;
//            }
//            $lrs->close();
//        } catch (Exception $exc) {
//            echo $exc->getMessage();
//            $tPays[] = new Pays("-1", $exc->getMessage());
//        }
//        return $tPays;
        try {
            // Les noms des colonnes doivent être identiques aux noms des attributs
            $lrs = $this->pdo->query("SELECT id_pays AS idPays, nom_pays AS nomPays FROM pays");
            // Chargement de toutes les données
            // Le constructeur de la classe doit avoir des paramètres facultatifs vides
            /*
              if you want to fetch your result into a class (by using PDO::FETCH_CLASS)
              and want the constructor to be executed *before* PDO assings the object properties, you need to use the PDO::FETCH_PROPS_LATE constant
             */
            /*
              PDOStatement::fetchAll() retourne un tableau contenant toutes les lignes du jeu d'enregistrements.
              Le tableau représente chaque ligne
              comme soit un tableau de valeurs des colonnes,
              soit un objet avec des propriétés correspondant à chaque nom de colonne.
              PDO::FETCH_CLASS: Retourne une instance de la classe désirée. Les colonnes sélectionnées sont liées aux attributs de la classe.
             */
            $tPays = $lrs->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Pays");
            // Fermeture du curseur
            $lrs->closeCursor();
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            $tPays = array();
            $tPays[] = new Pays("-1", $exc->getMessage());
        }
        return $tPays;
    }

}

?>