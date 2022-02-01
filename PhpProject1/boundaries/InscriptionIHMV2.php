<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription V2</title>
        <!--        Date du jour automatique en plus et max année = année en cours-->
   </head>
    <body>
        <h1>Inscription V2</h1>
        <form method="get" action="../controls/InscriptionCTRLV1.php">
            <label><strong>Pseudo</strong></label>
            <br>
            <input type="text" name="pseudo" value="Pascal" placeholder="Pseudo ?"/>
            <br>
            <label><strong>Mot de passe</strong></label>
            <br>
            <input type="text" name="mdp" value="Mdp89" placeholder="Mot de passe ?"/>
            <br>

            <label><strong>Date de naissance</strong></label>
            <br>
            <?php
            $aujourdhui = getdate();
            $jour = $aujourdhui['mday'];
            $mois = $aujourdhui['mon'];
            $annee = $aujourdhui['year'];
            ?>
            <select name="jour">
                <option value="0">--- Sélectionnez un jour ---</option>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    if ($i == $jour) {
                        echo "<option value='$i' selected>$i</option>\n";
                    } else {
                        echo "<option value='$i'>$i</option>\n";
                    }
                }
                ?>
            </select>
            <select name="mois">
                <option value="0">--- Sélectionnez un mois ---</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    if ($i == $mois) {
                        echo "<option value='$i' selected>$i</option>\n";
                    } else {
                        echo "<option value='$i'>$i</option>\n";
                    }
                }
                ?>
            </select>
            <select name="annee">
                <option value="0">--- Sélectionnez une année ---</option>
                <?php
                for ($i = 1900; $i <= $annee; $i++) {
                    if ($i == $annee) {
                        echo "<option value='$i' selected>$i</option>\n";
                    } else {
                        echo "<option value='$i'>$i</option>\n";
                    }
                }
                ?>
            </select>
            <br>
            <label><strong>Ville</strong></label>
            <br>
            <select name="ville">
                <option value="0">--- Sélectionnez une ville ---</option>
                <option value="75000" selected="selected">Paris</option>
                <option value="69000">Lyon</option>
                <option value="59000">Lille</option>
            </select>
            <br>
            <label><strong>Sexe</strong></label>
            <br>
            <label>Homme </label><input type="radio" name="rb_sexe" value="1" />
            <label>Femme </label><input type="radio" name="rb_sexe" value="2" />
            <br><!-- comment -->

            <label><strong>Catégorie</strong></label>
            <br>
            <label>Salarié  : </label><input type="checkbox" name="cbx_salarie" checked/>
            <label>Indépendant : </label><input type="checkbox" name="cbx_independant"/>
            <br>

            <label><strong>Description</strong></label>
            <br>
            <textarea name="description" rows="5" cols=="50" placeholder="Votre description ?">Je veux m'inscrire ...</textarea>
            <br>

            <input type="submit" />
        </form>

        <?php
        // put your code here
        ?>
    </body>
</html>
