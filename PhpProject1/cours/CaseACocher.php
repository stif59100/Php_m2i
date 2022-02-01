<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>Case à cocher</title>
    </head>
    <body>
        <form method="get" action="" >
            <label>Vélo  : </label><input type="checkbox" name="cbx_velo" />
            <label>Solex : </label><input type="checkbox" name="cbx_solex" value="1" />
            <input type="submit" value="OK" />
        </form>

        <?php
            $velo = filter_input(INPUT_GET, "cbx_velo");
            if ($velo != null) {
                echo "Un vélo";
            } else {
                echo "Pas de vélo";
            }
            $solex = filter_input(INPUT_GET, "cbx_solex");
            if ($solex != null) {
                echo "<br>Un solex-" . $solex;
            } else {
                echo "<br>Pas de Solex";
            }
        ?>
    </body>
</html>
