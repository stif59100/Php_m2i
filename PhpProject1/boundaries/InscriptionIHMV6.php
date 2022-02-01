<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription V6</title>
        <!-- 
        Date du jour automatique en plus et max année = année en cours cf V2
        Les mois en toutes lettres cf V3
        Les villes via un tableau associatif cf V4
        Les hobbies : liste à choix multiples
        Les catégories : case à cocher à choix multiples ?
        Des fonctions en plus
        -->
    </head>
    <body>
        <h1>Inscription V6</h1>
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
             * Diverses fonctions
             */
            /**
             * 
             * @param array $to
             * @param string $selected
             * @return string
             */
            function getOptionsFromOrdinalArray(array $to, $selected = ""): string {
                $options = "";
                for ($i = 0; $i < count($to); $i++) {
                    if ($selected == "") {
                        $options .= "<option value='$i'>$to[$i]</option>\n";
                    } else {
                        if ($i == $selected) {
                            $options .= "<option value='$i' selected>$to[$i]</option>\n";
                        } else {
                            $options .= "<option value='$i'>$to[$i]</option>\n";
                        }
                    }
                }
                return $options;
            }

            /**
             * 
             * @param array $hm
             * @param int $selected
             * @return string
             */
            function getOptionsFromHashMap(array $hm, int $selected = -1): string {
                $options = "";
                foreach ($hm as $cle => $valeur) {
                    $options .= "<option value='$cle'>$valeur</option>\n";
                }
                return $options;
            }

            /**
             * 
             * @param int $min
             * @param int $max
             * @param int $selected
             * @return string
             */
            function getOptionsFromMinMax(int $min, int $max, int $selected = -1): string {
                $options = "";
                for ($i = $min; $i <= $max; $i++) {
                    if ($i == $selected) {
                        $options .= "<option value='$i' selected>$i</option>\n";
                    } else {
                        $options .= "<option value='$i'>$i</option>\n";
                    }
                }
                return $options;
            }

            /*
             * INITIALISATION DE VARIABLES ET DES TABLEAUX QUI PERMETTENT DE REMPLIR LES LISTES (<select>)
             */
            $aujourdhui = getdate();
            $jour = $aujourdhui['mday'];
            $mois = $aujourdhui['mon']; // Commence à 1
//            echo "<hr>$mois<hr>";
            $annee = $aujourdhui['year'];

            $tMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

            $villes = array();
            $villes["75000"] = "Paris";
            $villes["59000"] = "Lille";
            $villes["69000"] = "Lyon";
            $villes["13000"] = "Marseille";

            //$hobbies = array("Opéra", "Foot", "Lecture", "Ecriture", "Piano", "Basket", "Tennis");
            $hobbies = array();
            $hobbies["OP"] = "Opéra";
            $hobbies["FO"] = "Foot";
            $hobbies["LE"] = "Lecture";
            $hobbies["EC"] = "Ecriture";
            $hobbies["PI"] = "Piano";
            $hobbies["BA"] = "Basket";
            $hobbies["TE"] = "Tennis";
            ?>

            <select name="jour">
                <option value="0">--- Sélectionnez un jour ---</option>
                <?php
//                for ($i = 1; $i <= 31; $i++) {
//                    if ($i == $jour) {
//                        echo "<option value='$i' selected>$i</option>\n";
//                    } else {
//                        echo "<option value='$i'>$i</option>\n";
//                    }
//                }
                echo getOptionsFromMinMax(1, 31, $jour);
                ?>
            </select>

            <select name="mois">
                <option value="-1">--- Sélectionnez un mois ---</option>
                <?php
//                for ($i = 0; $i < count($tMois); $i++) {
//                    //$numMois = $i + 1;
//                    if ($i == $mois) {
//                        echo "<option value='$i' selected>$tMois[$i]</option>\n";
//                    } else {
//                        echo "<option value='$i'>$tMois[$i]</option>\n";
//                    }
//                }
                echo getOptionsFromOrdinalArray($tMois, $mois - 1);
                ?>
            </select>

            <select name="annee">
                <option value="0">--- Sélectionnez une année ---</option>
                <?php
//                for ($i = 1900; $i <= $annee; $i++) {
//                    if ($i == $annee) {
//                        echo "<option value='$i' selected>$i</option>\n";
//                    } else {
//                        echo "<option value='$i'>$i</option>\n";
//                    }
//                }
                echo getOptionsFromMinMax(1900, $annee, $annee);
                ?>
            </select>

            <br>
            <label><strong>Ville</strong></label>
            <br>
            <select name="ville">
                <option value="0">--- Sélectionnez une ville ---</option>
                <?php
//                $optionsVilles = "";
//                foreach ($villes as $cp => $nomVille) {
//                    $optionsVilles .= "<option value='$cp'>$nomVille</option>\n";
//                }
//                echo $optionsVilles;
                echo getOptionsFromHashMap($villes);
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
//                $optionsHobbies = "";
//                for ($i = 0; $i < count($hobbies); $i++) {
//                    $optionsHobbies .= "<option value='$i'>$hobbies[$i]</option>\n";
//                }
//                echo $optionsHobbies;
                //echo getOptionsFromOrdinalArray($hobbies);
                echo getOptionsFromHashMap($hobbies);
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
