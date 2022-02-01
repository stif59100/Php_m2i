<?php

/*
 * PaysDAOTestsStatic.php
 */
// C'est ici qu'il faut le préciser !!!
declare(strict_types = 1);

require_once '../daos/Connexion.php';
require_once '../daos/Transaxion.php';
require_once '../entities/Pays.php';
require_once '../daos/PaysDAOStatic.php';

$cnx = new Connexion();
$tx = new Transaxion();

$pdo = $cnx->seConnecter("../conf/bd.ini");

$object = new Pays("BGR", "Bulgarie");
//$dao = new PaysDAO($pdo);

/*
 * INSERT
 */
echo "<hr>INSERT<br>";
$tx->initialiser($pdo);
$affected = PaysDAO::insert($pdo,$object);
echo "Insert ? $affected<br>";
if ($affected == 1) {
    $lbOK = $tx->valider($pdo);
    echo "Commit ? $lbOK";
} else {
    $lbOK = $tx->annuler($pdo);
    echo "Rollback ? $lbOK";
}


/*
 * SELECT ONE
 */
echo "<hr>SELECT ONE<br>";
$primaryKey = "BGR";
$p = PaysDAO::selectOne($pdo,$primaryKey);
echo $p->getIdPays() . ":" . $p->getNomPays();
/*
 * SELECT ALL
 */
echo "<hr>SELECT ALL<br>";
$t = PaysDAO::selectAll($pdo);
foreach ($t as $objet) {
    echo $objet->getIdPays() . ":" . $objet->getNomPays() . "<br>";
}

/*
 * UPDATE
 */
echo "<hr>UPDATE<br>";
$tx->initialiser($pdo);
$object->setIdPays("BGR");
$object->setNomPays("BULGARIE");
$affected = PaysDAO::update($pdo,$object);
echo "Update ? $affected<br>";
if ($affected == 1) {
    $lbOK = $tx->valider($pdo);
    echo "Commit ? $lbOK";
} else {
    $lbOK = $tx->annuler($pdo);
    echo "Rollback ? $lbOK";
}
/*
 * SELECT ALL
 */
echo "<hr>SELECT ALL<br>";
$t = PaysDAO::selectAll($pdo);
foreach ($t as $objet) {
    echo $objet->getIdPays() . ":" . $objet->getNomPays() . "<br>";
}

/*
 * DELETE
 */
//echo "<hr>DELETE<br>";
//$tx->initialiser($pdo);
//$object->setIdPays("BGR");
//$object->setNomPays("BULGARIE");
//$affected = $dao->delete($object);
//echo "Delete ? $affected<br>";
//if ($affected == 1) {
//    $lbOK = $tx->valider($pdo);
//    if ($lbOK) {
//        echo "Commit DELETE OK<br>";
//    } else {
//        echo "Commit DELETE KO<br>";
//    }
//} else {
//    $lbOK = $tx->annuler($pdo);
//    echo "Rollback ? $lbOK";
//}


/*
 * SELECT ALL
 */
echo "<hr>SELECT ALL<br>";
$t = PaysDAO::selectAll($pdo);
foreach ($t as $objet) {
    echo $objet->getIdPays() . ":" . $objet->getNomPays() . "<br>";
}

$cnx->seDeconnecter($pdo);
?>
