 <!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>ListeDeroulanteJours.php</title>
    </head>

    <body>
        <form method="get" action="">
            <select name="listeJours">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>\n";
                    //retour à la ligne = \n
                }
                ?>
            </select>

            <input type="submit" />
        </form>
        <?php
            $jour = filter_input(INPUT_GET, "listeJours");
            if ($jour != null) {
                echo "Jour sélectionné : " . $jour;
            }
        ?>
    </body>
</html>