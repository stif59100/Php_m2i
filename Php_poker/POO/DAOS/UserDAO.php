<?php

/*
 * PaysDAO.php
 */
// PHP 7 full
declare(strict_types=1);

// On charge le fichier
require_once '../entities/User.php';


// Déclaration de la classe
class UserDAO {

    // On déclare un attribut
    private $pdo;

    // Le constructeur qui a comme paramètre un objet PDO et qui sera exécuté automatiquement quand on va instancier l'objet
    function __construct(PDO $pdo) {
        // On affecte la valeur du paramètre à l'attribut
        $this->pdo = $pdo;
    }

    /**
     * Déclaration de la méthode INSERT :: input : un objet pays , output : un numérique entier
     * @param Pays $pays
     * @return int
     */
    public function insert(User $user): int {
        // Déclaration d'une variable qui servira pour le retour
        $affected = 0;

        try {
            // Compilation ...
            $cmd = $this->pdo->prepare("INSERT INTO user(id_user, name_user, firstname_user,pseudo_user, email_user, password_user) VALUES('',?,?,?,?,?)");
            // Valorisation des paramètres (les ?) avec le résultat de la sollicitation de la méthode GETTER de l'objet User
            $cmd->bindValue(1, $user->getNameUser());
            $cmd->bindValue(2, $user->getFirstnameUser());
            $cmd->bindValue(3, $user->getPseudoUser());
            $cmd->bindValue(4, $user->getEmailUser());
            $cmd->bindValue(5, $user->getPasswordUser());
            // On exécute la roquette
            $cmd->execute();
            // Nombre de lignes affectées (0 ou 1)
            $affected = $cmd->rowCount();
        } catch (Exception $exc) {
            $affected = -1;
        }

        // Le retour de la méthode (l'output)
        return $affected;
    }

    public function update(User $user): int {
        $affected = 0;

        try {
            $lcmd = $this->pdo->prepare("UPDATE user SET name_user = ? WHERE id_user = ?");
            $lcmd->bindValue(1, $user->getNameUser());
            $lcmd->bindValue(2, $user->getIdUser());
            $lcmd->execute();
            $affected = $lcmd->rowCount();
        } catch (Exception $exc) {
            $affected = -1;
        }
        return $affected;
    }
    
    public function delete(User $user): int {
        $affected = 0;

        try {
            $lcmd = $this->pdo->prepare("DELETE FROM user WHERE id_user = ?");
            $lcmd->bindValue(1, $user->getIdUser());
            $lcmd->execute();
            $affected = $lcmd->rowCount();
        } catch (Exception $exc) {
            $affected = -1;
        }
        return $affected;
    }

    public function selectOne($pk): User {

        try {
            $cursor = $this->pdo->prepare("SELECT * FROM user WHERE id_user = ?");
            $cursor->bindParam(1, $pk);
            $cursor->execute();
            $record = $cursor->fetch();
            if ($record != null) {
                $User = new User($record[0], $record[1]);
            } else {
                $User = new User("0", "Introuvable");
            }
            $cursor->closeCursor();
        } catch (Exception $exc) {
            $User = new User("-1", $exc->getMessage());
        }
        return $User;
    }
    
    public function selectAll(): array {

//        $tPays = array();
//        try {
//            $cursor = $this->pdo->query("SELECT * FROM pays");
//            $cursor->setFetchMode(PDO::FETCH_ASSOC);
//            while ($record = $cursor->fetch()) {
//                $pays = new Pays($record["id_pays"], $record["nom_pays"]);
//                $tPays[] = $pays;
//            }
//            $cursor->close();
//        } catch (Exception $exc) {
//            $tPays[] = new Pays("-1", $exc->getMessage());
//        }
//        return $tPays;
        try {
            // Les noms des colonnes doivent avoir des alias identiques aux noms des attributs
            $cursor = $this->pdo->query("SELECT pseudo_user AS pseudoUser, name_user AS nameUser FROM user");
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
            $tUser = $cursor->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
            // Fermeture du curseur
            $cursor->closeCursor();
        } catch (Exception $exc) {
            $tUser = array();
            $tUser[] = new User("-1", $exc->getMessage());
        }
        return $tUser;
    }

}

?>