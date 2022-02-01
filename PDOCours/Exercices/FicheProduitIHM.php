<!DOCTYPE html>
<!-- FicheProduitIHM.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>FicheProduitIHM</title>
    </head>

    <body>
        <h3>Fiche Produit</h3>
        <form action="FicheProduitCTRL.php" method="POST">
            <table>
                <tr>
                    <td>Désignation : </td>
                    <td><input type="text" name="designation" id="designation"value="p" /></td>
                </tr>
                
                <tr>
                    <td><input type="submit" value="Valider" name="btValider" id="btValider"/></td>
                </tr>
            </table>
        </form>

        <table>
            <?php
            echo $message;
            ?>
        </tab>
    </body>
</html>