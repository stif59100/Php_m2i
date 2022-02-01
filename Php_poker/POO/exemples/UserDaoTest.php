<?php

// UserDaoTest.php

require_once '../entities/User.php';
require_once '../DAOS/UserDAO.php';

try {
// Connexion
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=poker;", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'UTF8'");
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

$dao = new UserDAO($pdo);
$user = "";
/*
 * Insert
 */
$user = new User("testName", "testFirstname", "TestEmail", "TestPseudo", "TestPwd");
//$affected = $dao->insert($user);
//echo $affected;



/*
 * SELECT ONE
 */

echo "<hr>SELECT ONE<br>";
$p = $dao->selectOne("11");
echo $p->getIdUser() . ":" . $p->getNameUser();

/*
 * SELECT ALL
 */
echo "<hr>SELECT ALL<br>";
$t = $dao->selectAll();
echo "<select>";
foreach ($t as $objet) {
    echo "<option value='$objet->getIdUser()'>" . $objet->getPseudoUser() . "</option>";
}
echo "</select>";


/*
* DELETE
*/
echo "<hr>DELETE<br>";
//$tx->initialiser($pdo);
$user->setIdUser("31");
$affected = $dao->delete($user);
echo "Delete ? $affected<br>";
//if ($affected == 1) {
 //$lbOK = $tx->valider($pdo);
 //if ($lbOK) {
//echo "Commit DELETE OK<br>";
//} else {
 //echo "Commit DELETE KO<br>";
//}
//} else {
 //$lbOK = $tx->annuler($pdo);
 //echo "Rollback ? $lbOK";
//}
    
    
/*
* UPDATE
*/
//echo "<hr>UPDATE<br>";
//$tx->initialiser($pdo);
//$user->setIdUser("22");
//$user->setNameUser("Abc");
//$affected = $dao->update($user);
//echo "Update ? $affected<br>";
//if ($affected == 1) {
// echo $affected;
// $lbOK = $tx->valider($pdo);
// echo "Commit ? $lbOK";
//} else {
// $lbOK = $tx->annuler($pdo);
// echo "Rollback ? $lbOK";
//}
