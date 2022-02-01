<!DOCTYPE html>
<!-- ProduitsInsertIHM.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ProduitsInsertIHM</title>
    </head>
    <body>
        <form action="ProduitsInsertCTRL.php" method="get">
            <label>Désignation </label>
            <input type="text" name="designation" value="Vichy" />
            <label>Prix </label>
            <input type="text" name="prix" value="2.1" />
            <input type="submit" name="btInsert"/>
        </form><br>
        <label>
            <?php
            if (isSet($message) && $message != "") {
                echo $message;
            }
            ?>
        </label>
    </body>
</html>
