<?php

/**
 * 
 * @param PDO $connection
 * @return array
 */
function authentification(PDO $connection, $data): array {
    try {
        $sql = "SELECT * FROM user where email_user = ? and password_user = ? LIMIT 1 ";
        $cursor = $connection->prepare($sql);
        $cursor->bindParam(1, $data["email_user"], PDO::PARAM_STR);
        $cursor->bindParam(2, $data["password_user"], PDO::PARAM_STR);
        $cursor->execute();
        // Tableau ordinal de tableaux
        $array = $cursor->fetchAll();
        $cursor->closeCursor();
    } catch (PDOException $e) {
        echo $e->getTraceAsString();
        $array = array();
    }
    return $array;
}

function users(PDO $connection): array {
    try {
        $sql = "SELECT * FROM user";
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
function selectUser(PDO $connection, string $pk): array {
    try {
        // Le selectOne()
        $sql = "SELECT * FROM user WHERE pseudo_user=?";

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

function selectUsers(PDO $connection): array {
    try {
        // Le selectOne()
        $sql = "SELECT id_user, pseudo_user FROM user";

        $cursor = $connection->prepare($sql);
        
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
function register(PDO $connection, array $data): int {
    try {
        $sql = "INSERT INTO user(name_user, firstname_user, pseudo_user, email_user, password_user) VALUES(?,?,?,?,?)";

        $statement = $connection->prepare($sql);

        $statement->bindParam(1, $data["name_user"], PDO::PARAM_STR);
        $statement->bindParam(2, $data["firstname_user"], PDO::PARAM_STR);
        $statement->bindParam(3, $data["pseudo_user"], PDO::PARAM_STR);
        $statement->bindParam(4, $data["email_user"], PDO::PARAM_STR);
        $statement->bindParam(5, $data["password_user"], PDO::PARAM_STR);
        $statement->bindParam(5, $data["password_user"], PDO::PARAM_STR);

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
        $sql = "DELETE FROM user WHERE email_user = ?";

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
        $sql = "UPDATE users SET name_user=?, firstname_user=?, pseudo_user=?, password_user=? WHERE email_user=?";

         

        $statement = $connection->prepare($sql);

        $statement->bindParam(1, $data["name_user"]); // BIND = RELIER
        $statement->bindParam(2, $data["firstname_user"]);
        $statement->bindParam(3, $data["pseudo_user"]);
        $statement->bindParam(4, $data["password_user"]);
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

