<!DOCTYPE html>
<!-- VillesDeletePrepareeIHM.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesDeletePrepareeIHM</title>
    </head>
    <body>
        <form action="VillesDeletePrepareeCTRL.php" method="POST">
            
            <label>CP :</label>
            <input type="text" name="cp" placeholder="Saisissez votre CP" />
            <input type="submit" value="Supprimer" name="btInsert"/>
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