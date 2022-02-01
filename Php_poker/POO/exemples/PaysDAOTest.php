<?php



/*
* PaysDAOTest.php
*/
// C'est ici qu'il faut le préciser !!!
declare(strict_types=1);



//require_once '../daos/Connexion.php';
//require_once '../daos/Transaxion.php';
require_once '../entities/Pays.php';
require_once '../daos/PaysDAO.php';



//$cnx = new Connexion();
//$tx = new Transaxion();
//$pdo = $cnx->seConnecter("../conf/bd.ini");
//$tx->initialiser($pdo);




try {
// Connexion
$pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET NAMES 'UTF8'");
} catch (Exception $exc) {
echo $exc->getTraceAsString();
}




$user = new Pays("BGR", "Bulgarie");
$dao = new PaysDAO($pdo);



/*
* INSERT
*/
echo "<hr>INSERT<br>";
//$tx->initialiser($pdo);
$affected = $dao->insert($user);
echo "Insert ? $affected<br>";
//if ($affected == 1) {
// $lbOK = $tx->valider($pdo);
// echo "Commit ? $lbOK";
//} else {
// $lbOK = $tx->annuler($pdo);
// echo "Rollback ? $lbOK";
//}



/*
* SELECT ONE
*/
echo "<hr>SELECT ONE<br>";
$p = $dao->selectOne("BGR");
echo $p->getIdPays() . ":" . $p->getNomPays();
/*
* SELECT ALL
*/
echo "<hr>SELECT ALL<br>";
$t = $dao->selectAll();
foreach ($t as $objet) {
echo $objet->getIdPays() . ":" . $objet->getNomPays() . "<br>";
}



/*
* UPDATE
*/
echo "<hr>UPDATE<br>";
//$tx->initialiser($pdo);
$user->setIdPays("BGR");
$user->setNomPays("BULGARIE");
$affected = $dao->update($user);
echo "Update ? $affected<br>";
//if ($affected == 1) {
// echo $affected;
// $lbOK = $tx->valider($pdo);
// echo "Commit ? $lbOK";
//} else {
// $lbOK = $tx->annuler($pdo);
// echo "Rollback ? $lbOK";
//}
/*
* SELECT ALL
*/
echo "<hr>SELECT ALL<br>";
$t = $dao->selectAll();
foreach ($t as $objet) {
echo $objet->getIdPays() . ":" . $objet->getNomPays() . "<br>";
}



/*
* DELETE
*/
//echo "<hr>DELETE<br>";
//$tx->initialiser($pdo);
$user->setIdPays("BGR");
$user->setNomPays("");
$affected = $dao->delete($user);
echo "Delete ? $affected<br>";
//if ($affected == 1) {
// $lbOK = $tx->valider($pdo);
// if ($lbOK) {
// echo "Commit DELETE OK<br>";
// } else {
// echo "Commit DELETE KO<br>";
// }
//} else {
// $lbOK = $tx->annuler($pdo);
// echo "Rollback ? $lbOK";
//}



/*
* SELECT ALL
*/
echo "<hr>SELECT ALL<br>";
$t = $dao->selectAll();
foreach ($t as $objet) {
echo $objet->getIdPays() . ":" . $objet->getNomPays() . "<br>";
}



//$cnx->seDeconnecter($pdo);
?>
