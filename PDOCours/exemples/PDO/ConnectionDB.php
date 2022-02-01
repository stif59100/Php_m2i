<?php
// ConnectionDB.php
/**
 * 
 * @param string $host
 * @param string $db
 * @param string $user
 * @param string $pwd
 * @return PDO
 */
function getConnection(string $host, string $db, string $user, string $pwd): PDO {
    try {
        // --- Connexion ... dans tous les cas
        $connection = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("SET NAMES 'UTF8'");
    } catch (PDOException $e) {
        echo $e;
        $connection = null;
    }
    return $connection;
}

?>
