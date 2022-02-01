<?php

/*
  ProduitsDAO.php
 */
/*
  LE DAO de la table [produits] de la BD [cours]
 */
declare(strict_types=1);

require_once '../entities/Produits.php';

class ProduitsDAO {

    /**
     * 
     * @param PDO $pdo
     * @return type
     */
    public static function selectAll(PDO $pdo) {
        $liste = array();
        try {
            $sql = 'SELECT * FROM cours.produits';
            $lrs = $pdo->query($sql);
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
//            while ($enr = $lrs->fetch()) {
//                $objet = new Produits($enr['designation'], floatval($enr['prix']), intval($enr['qte_stockee']), $enr['photo'], $enr['categorie'], intval($enr['id_produit']));
//                $liste[] = $objet;
//            }
//            foreach ($lrs as $produit) {
//                $objet = new Produits($produit['designation'], floatval($produit['prix']), intval($produit['qte_stockee']), $produit['photo'], $produit['categorie'], intval($produit['id_produit']));
//                $liste[] = $objet;
//            }
//            // Impossible avec des retours NULL
            $liste = $lrs->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Produits");
            $lrs->closeCursor();
        } catch (PDOException $e) {
            $objet = null;
            $liste[] = $objet;
        }
        return $liste;
    }

    /**
     * 
     * @param PDO $pdo
     * @param int $id
     * @return Produits
     */
    public static function selectOne(PDO $pdo, int $id): Produits {
        try {
            $sql = 'SELECT * FROM cours.produits WHERE id_produit = ?';
            $lcmd = $pdo->prepare($sql);
            $lcmd->bindValue(1, $id);
            $lrs = $lcmd->execute();
            $enr = $lcmd->fetch(PDO::FETCH_ASSOC);
            // Avec un IF
            if ($enr['photo'] == NULL) {
                $photo = "Image absente";
            } else {
                $photo = $enr['photo'];
            }
            // Avec une TERNAIRE
            $categorie = $enr['categorie'] == NULL ? "Catégorie absente" : $enr['categorie'];
            $objet = new Produits($enr['designation'], floatval($enr['prix']), intval($enr['qte_stockee']), $photo, $categorie, intval($enr['id_produit']));
            $lcmd->closeCursor();
        } catch (PDOException $e) {
            $objet = null;
        }
        return $objet;
    }

    /**
     * 
     * @param PDO $pdo
     * @param Produits $objet
     * @return int
     */
    public static function delete(PDO $pdo, Produits $objet): int {
        $liAffectes = 0;
        try {
            $sql = "DELETE FROM cours.produits WHERE id_produit = ?";
            $lcmd = $pdo->prepare($sql);
            $lcmd->bindValue(1, $objet->getIdProduit());
            $lcmd->execute();
            $liAffectes = $lcmd->rowcount();
        } catch (PDOException $e) {
            $liAffectes = -1;
        }
        return $liAffectes;
    }

    /**
     * 
     * @param PDO $pdo
     * @param Produits $objet
     * @return int
     */
    public static function insert(PDO $pdo, Produits $objet): int {
        $liAffectes = 0;
        try {
            $sql = "INSERT INTO cours.produits(id_produit,designation,prix,qte_stockee,photo,categorie) VALUES(?,?,?,?,?,?)";
            $lcmd = $pdo->prepare($sql);
            $lcmd->bindValue(1, $objet->getIdProduit());
            $lcmd->bindValue(2, $objet->getDesignation());
            $lcmd->bindValue(3, $objet->getPrix());
            $lcmd->bindValue(4, $objet->getQteStockee());
            $lcmd->bindValue(5, $objet->getPhoto());
            $lcmd->bindValue(6, $objet->getCategorie());

            $lcmd->execute();
            $liAffectes = $lcmd->rowcount();
        } catch (PDOException $e) {
            $liAffectes = -1;
        }
        return $liAffectes;
    }

    /**
     * 
     * @param PDO $pdo
     * @param Produits $objet
     * @return int
     */
    public static function update(PDO $pdo, Produits $objet): int {
        $liAffectes = 0;
        try {
            $sql = "UPDATE cours.produits SET designation=?,prix=?,qte_stockee=?,photo=?,categorie=? WHERE id_produit=?";
            $lcmd = $pdo->prepare($sql);
            $lcmd->bindValue(1, $objet->getDesignation());
            $lcmd->bindValue(2, $objet->getPrix());
            $lcmd->bindValue(3, $objet->getQteStockee());
            $lcmd->bindValue(4, $objet->getPhoto());
            $lcmd->bindValue(5, $objet->getCategorie());
            $lcmd->bindValue(6, $objet->getIdProduit());

            $lcmd->execute();
            $liAffectes = $lcmd->rowcount();
        } catch (PDOException $e) {
            $liAffectes = -1;
        }
        return $liAffectes;
    }

}

?>
