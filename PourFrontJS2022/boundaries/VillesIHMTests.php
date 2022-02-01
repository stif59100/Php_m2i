<!DOCTYPE html>
<!--
VillesIHMTests.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesIHMTests.php</title>
    </head>
    <body>
        <?php
        // 
        ?>
        <form action="../controls/VillesCTRLSelectAll.php" method="GET">
            <input type="submit" value="Villes SelectAll" name="btVillesSelectAll" />
        </form>
        <hr>
        <form action="../controls/VillesCTRLSelectOne.php" method="GET">
            <input type="submit" value="Villes SelectOne" name="btVillesSelectOne" />
            <input type="text" name="cp" value="75011" placeholder="CP ?"/>
        </form>
        <hr>
        <form action="../controls/VillesCTRLDelete.php" method="POST">
            <input type="submit" value="Villes Delete" name="btVillesDelete" />
            <input type="text" name="cp" value="75021" placeholder="CP ?"/>
        </form>
        <hr>
        <form action="../controls/VillesCTRLInsert.php" method="POST">
            <input type="submit" value="Villes Insert" name="btVillesInsert" />
            <input type="text" name="cp" value="75021" placeholder="CP ?"/>
            <input type="text" name="nomVille" value="Paris 21" placeholder="Ville ?"/>
            <input type="text" name="site" value="www.paris21.fr" placeholder="Site ?"/>
            <input type="text" name="photo" value="paris21.jpg" placeholder="Photo ?"/>
            <input type="text" name="idPays" value="033" placeholder="ID Pays ?"/>
        </form>
    </body>
</html>
