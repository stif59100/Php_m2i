<!DOCTYPE html>
<!--
VillesInsertIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesInsertIHM</title>
    </head>
    <body>
        <h3>INSERT</h3>
        <form action="VillesInsertCTRL.php" method="post">
            <label>CP </label>
            <input type="text" name="cp" value="75021" size="5" />
            <label>Ville </label>
            <input type="text" name="nomVille" value="Paris 21" />
            <label>ID pays </label>
            <input type="text" name="idPays" value="033" size="4" />

            <input type="submit" />
        </form>

        <br>

        <label>
            <?php
            if (isSet($message)) {
                echo $message;
            }
            ?>
        </label>
    </body>
</html>