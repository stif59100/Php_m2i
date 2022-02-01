<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>BoutonsRadio</title>
    </head>

    <body>
        <form method="get" action="" >
            <label>Homme </label><input type="radio" name="rb_sexe" value="1" />
            <label>Femme </label><input type="radio" name="rb_sexe" value="2" />
            <input type="submit" />
        </form>

        <?php
        $sexe = filter_input(INPUT_GET, "rb_sexe");
        if ($sexe != null) {
            if ($sexe == "1") {
                echo "Homme";
            } else {
                echo "Femme";
            }
        } else {
            echo "Aucun bouton radio sélectionné";
        }
        ?>
    </body>
</html>
