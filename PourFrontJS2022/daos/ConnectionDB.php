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

// fonction paramétrée les paramètres sont typés pour garantir la qualité du code
// :pdo => type de la fonction
function getConnection(string $host, string $db, string $user, string $pwd): PDO {
    //bloc de code où l'on essaie de l'exécuter accompagné par un catch (gestion des serreurs)
    // On utilise try/catch lors de l'opération input/ouput
    try {
        // --- Connexion ... dans tous les cas
        // on instancie un objet pdo
        // Les arguments sont le DSN
        $connection = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        // les erreurs sont traitées comme des exceptions
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // le noyau est en UTF-8
        $connection->exec("SET NAMES 'UTF8'");
    } catch (PDOException $e) {
        echo $e;
        $connection = null;
    }
    return $connection;
}

?>
