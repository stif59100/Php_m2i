<!-- VillesUpdatePrepareeIHM.php -->
<!-- VillesUpdatePrepareCTRL.php à exécuter en premier -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VillesUpdatePrepareeIHM</title>
        <style>
            p{
                margin: 3px;
            }
        </style>
    </head>
    <body>
        <?php
        ?>
        <form action="VillesUpdatePrepareeCTRLWithFunctions.php" method="POST">
            <label for="lbVilles">Quelle ville ?</label>
            <select name="lbVilles" id="lbVilles">
                <?php echo $options; ?>
            </select>
            <input type="submit" name="btSelectionner" value="Sélectionner"/>

            <hr>
            <p><label for="nomVille">Ville</label></p>
            <p>
                <input type="text" name="nomVille" id="nomVille" value="<?php echo $nomVille; ?>" />
            </p>
            <p><label for="idPays">ID Pays</label></p>
            <p>
                <input type="text" name="idPays" id="idPays" value="<?php echo $idPays; ?>" size="4" />
            </p>
            <p>
                <input type="submit" name="btModifier" value="Modifier"/>
            </p>
        </form>

        <p>
            <?php
            if (isSet($message)) {
                echo $message;
            }
            ?>
        </p>
    </body>
</html>