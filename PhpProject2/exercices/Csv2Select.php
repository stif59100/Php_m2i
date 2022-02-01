<!DOCTYPE html>
<!--
Csv2Select.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // 
        $contenu = file_get_contents("../ressources/personnages.txt");
        // \n est le saut de ligne Linux, iOS et aussi WinDaube
        $tEnregistrements = explode("\n", $contenu);
//        echo "<pre>";
//        var_dump($tEnregistrements);
//        echo "</pre>";
        $options = "";
        // Parcours du tableau du 2e élément jusqu'à la fin, parce je ne veux pas les nom des champs
        for ($i = 1; $i < count($tEnregistrements); $i++) {
            // J'explose chaque ligne du tableau dans un autre tableau de champs
            if (trim($tEnregistrements[$i]) != "") {
                $tChamps = explode(";", $tEnregistrements[$i]);
                $options .= "<option>" . $tChamps[1] . "</option>";
            }
        }
        ?>

        <form>
            <select name="listeDeNoms">
                <?php
                echo $options;
                ?>
            </select>
            <input type="submit" />
        </form>
    </body>
</html>