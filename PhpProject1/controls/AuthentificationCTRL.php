<?php



/*
* AuthentificationCTRL.php
*/
/*
* Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
* Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
*/



$pseudo = filter_input(INPUT_GET, "pseudo");
if ($pseudo == null) {
$pseudo = "Pseudo vide !!!";
} else {
if ($pseudo != "Steeve") {
$pseudo = "Pseudo incorrect";
} else {
echo $pseudo;
}
}



echo "<br />";



$mdp = filter_input(INPUT_GET, "mdp");
if ($mdp == null) {
echo "MDP vide !!!";
$mdp = "MDP vide !!!";
} else {
echo $mdp;
}




echo "<br />";



$btValider = filter_input(INPUT_GET, "btValider");
echo $btValider;



echo "<br/>$pseudo<br/>$mdp<br/>$btValider";



//echo "<br/>" . $pseudo . "<br/>" . $mdp . "<br/>" . $btValider;
//echo '<br/>$pseudo<br/>$mdp<br/>$btValider';
?>