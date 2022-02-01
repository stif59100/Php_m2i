<!DOCTYPE html>
<!-- AuthentificationIHM.php -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Authentification</title>
    </head>

    <body>
        <h3>Authentification</h3>
        <form action="AuthentificationCTRL.php" method="POST">
            <table>
                <tr>
                    <td>Pseudo : </td>
                    <td><input type="text" name="pseudo" id="pseudo"value="p" /></td>
                </tr>
                <tr>
                    <td>Mot de passe : </td>
                    <td><input type="password" name="mdp" id="mdp" value="b" /></td>
                </tr>
                <tr>
                    <td><input type="reset" value="R&eacute;initialiser" name="btReinitialiser" id="btReinitialiser"/></td>
                    <td><input type="submit" value="Valider" name="btValider" id="btValider"/></td>
                </tr>
            </table>
        </form>

        <label>
            <?php
            //echo $message;
            ?>
        </label>
    </body>
</html>