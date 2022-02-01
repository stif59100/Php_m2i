<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription V5</title>
        <!-- 
        Date du jour automatique en plus et max année = année en cours cf V2
        Les mois en toutes lettres cf V3
        Les villes via un tableau associatif cf V4
        Les hobbies : liste à choix multiples
        Les catégories : case à cocher à choix multiples ?
        -->
    <script type="text/javascript" src="https://ff.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=nfKcSViw4-Tm_ANML7E_R8bmQbKCBmoNEEZYTrLrznQbuTCR2A2Hu9b5yJFmNNZnQ7quEo7exLK1P8kwshHIKkMQLVUr7aYlYpNfSR8qwN9ObiU_fFsmNab3uOEMeXuULP66Jn_oq48SVBPsBjk3JwFYZcAgSIWFx7EzIb0QxQP0K-JvcX6Yo5hP9nRyVfjlrB7uZfmneBn0rI4cQpKQHtTL1zoWp3yebHvfeN9sk_NJESHifyCEr_0Zn8B5tYPOQVzfuLwK4mv9UvaICO3iVqC7rPrGxBcSLQPkaqmXMeLeUZpARACyYsv5_GsNK8nkTJkXGiCX83Jp2J6pg_ojDS4ePeAv4wKzkddlLXp1POEc_Uxk5KxhjuCzaCDCx0Wak0lst_eUEUPSG8O0nbQs4WwjJZ1anPrkIzl914sDQHGdED3gz_QzJEaZ3-eemtXtkDGnm_bN7Y7Ze08ypFVqKg" charset="UTF-8"></script></head>
    <body>
        <h1>Inscription V5</h1>
        <form method="get" action="../controls/InscriptionCTRLV5.php">
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
            /*
             * INITIALISATION DE VARIABLES ET DES TABLEAUX QUI PERMETTENT DE REMPLIR LES LISTES (<select>)
             */
            $aujourdhui = getdate();
            $jour = $aujourdhui['mday'];
            $mois = $aujourdhui['mon'];
            $annee = $aujourdhui['year'];

            $tMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

            $villes = array();
            $villes["75000"] = "Paris";
            $villes["59000"] = "Lille";
            $villes["69000"] = "Lyon";
            $villes["13000"] = "Marseille";

            $hobbies = array("Opéra", "Foot", "Lecture", "Ecriture", "Piano", "Basket", "Tennis");
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
                for ($i = 0; $i < count($tMois); $i++) {
                    //$numMois = $i + 1;
                    if ($i == $mois) {
                        echo "<option value='$i' selected>$tMois[$i]</option>\n";
                    } else {
                        echo "<option value='$i'>$tMois[$i]</option>\n";
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
                <?php
                $optionsVilles = "";
                foreach ($villes as $cp => $nomVille) {
                    $optionsVilles .= "<option value='$cp'>$nomVille</option>\n";
                }
                echo $optionsVilles;
                ?>
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

            <label><strong>Hobbies</strong></label>
            <br>
            <select name="hobbies[]" multiple="multiple">
                <option value="-1">--- Sélectionnez aucun, un ou plusieurs hobbies ---</option>
                <?php
                $optionsHobbies = "";
                for ($i = 0; $i < count($hobbies); $i++) {
                    $optionsHobbies .= "<option value='$i'>$hobbies[$i]</option>\n";
                }
                echo $optionsHobbies;
                ?>
            </select>
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
