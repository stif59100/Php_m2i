<?php

/**
 * 
 * @param PDO $connection
 * @return array
 */
function selectAll(PDO $connection): array {
    try {
        $sql = "SELECT * FROM villes ORDER BY nom_ville";
        $cursor = $connection->query($sql);
        // Tableau ordinal de tableaux
        $array = $cursor->fetchAll();
        $cursor->closeCursor();
    } catch (PDOException $e) {
        echo $e->getTraceAsString();
        $array = array();
    }
    return $array;
}

/**
 * 
 * @param PDO $connection
 * @param string $pk
 * @return array
 */
function selectOne(PDO $connection, string $pk): array {
    try {
        // Le selectOne()
        $sql = "SELECT * FROM villes WHERE cp = ?";

        $cursor = $connection->prepare($sql);
        $cursor->bindValue(1, $pk);
        $cursor->execute();

        $array = $cursor->fetchAll();
    } catch (PDOException $e) {
        echo $e->getTraceAsString();
        $array = array();
    }
    return $array;
}

/**
 * 
 * @param PDO $connection
 * @param array $data
 * @return int
 */
function insert(PDO $connection, array $data): int {
    try {
        $sql = "INSERT INTO villes(cp, nom_ville, site, photo, id_pays) VALUES(?,?,?,?,?)";

        $statement = $connection->prepare($sql);

        $statement->bindParam(1, $data["cp"], PDO::PARAM_STR);
        $statement->bindParam(2, $data["nomVille"], PDO::PARAM_STR);
        $statement->bindParam(3, $data["site"], PDO::PARAM_STR);
        $statement->bindParam(4, $data["photo"], PDO::PARAM_STR);
        $statement->bindParam(5, $data["idPays"], PDO::PARAM_STR);

        $statement->execute();

        $affected = $statement->rowcount();
    } catch (PDOException $e) {
        echo $e->getTraceAsString();
        $affected = -1;
    }
    return $affected;
}

/**
 * 
 * @param PDO $connection
 * @param string $pk
 * @return int
 */
function delete(PDO $connection, string $pk): int {
    try {
        $sql = "DELETE FROM villes WHERE cp = ?";

        $statement = $connection->prepare($sql);

        $statement->bindParam(1, $pk);

        $statement->execute();

        $affected = $statement->rowcount();
    } catch (PDOException $e) {
        echo $e->getTraceAsString();
        $affected = -1;
    }
    return $affected;
}

/**
 * 
 * @param PDO $connection
 * @param string $pk
 * @param array $data
 * @return int
 */
function update(PDO $connection, string $pk, array $data): int {
    try {
        $sql = "UPDATE villes SET nom_ville=?, site=?, photo=?, id_pays=? WHERE cp=?";

        $statement = $connection->prepare($sql);

        $statement->bindParam(1, $data["nomVille"]); // BIND = RELIER
        $statement->bindParam(2, $data["site"]);
        $statement->bindParam(3, $data["photo"]);
        $statement->bindParam(4, $data["idPays"]);
        $statement->bindParam(5, $pk);

        $statement->execute();
        //$statement->execute(array($nomVille, $idPays, $cp));

        $affected = $statement->rowcount();
    } catch (PDOException $e) {
        echo $e->getTraceAsString();
        $affected = -1;
    }
    return $affected;
}

?>