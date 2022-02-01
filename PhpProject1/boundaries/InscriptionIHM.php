<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <form action="../controls/InscriptionCTRL.php" method="GET">
            Votre pseudo <input type="text" name="pseudo" value="" placeholder="Pseudo?" /><br>
            Votre mot de passe<input type="text" name="mdp" value="" placeholder="MDP?" /><br>
            Votre date de naissance <select name="listeJours"> 
                <option value="0">Sélectionner un jour</option>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>\n";
                    //retour à la ligne = \n
                }
                ?>
            </select>      
            <select name="listeMois">
                <option value="0">Sélectionner un mois</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo "<option value='$i'>$i</option>\n";
                    //retour à la ligne = \n
                }
                ?>
            </select> 
            <select name="listeAnnée">
                <option value="0">Sélectionner une année</option>
                <?php
                for ($i = 1930; $i <= 2022; $i++) {
                    echo "<option value='$i'>$i</option>\n";
                    //retour à la ligne = \n
                }
                ?>
            </select><br>
            
            Ville :<select name="listeVille">
                <option value="">Sélectionner une Ville</option>
                <option value="59100">Roubaix</option>
                <option value="59000">Lille</option>
                <option value="13000">Marseille</option>
            </select><br>
             <label>Salarié  : </label><input type="checkbox" name="cbx_salarie" />
             <label>Indépendant : </label><input type="checkbox" name="cbx_independant" value="1" /><br>
             <label>Homme </label><input type="radio" name="rb_sexe" value="1" />
             <label>Femme </label><input type="radio" name="rb_sexe" value="2" /><br>
            <input type="submit" value="Valider" name="btValider" />
        </form>

        <?php
        // put your code here
        ?>
    </body>
</html>
