<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
    require_once './ConnectionDB.php';
    require_once './dao.php';
    $connection = getConnection("127.0.0.1", "poker", "root", "");
    $authentification = authentification($connection);
    $pseudoUsers = selectUsers($connection);
    ?>

    <body>
        <h1>authentification</h1>
         
        <form type="get" name="authentification">
            Email : <input name='email_user' type="text" placeholder="Email">
            Mdp : <input name='password_user' type="password" placeholder="Votre mdp" >
            <button type="submit" value="valider" name="btnAuth">Valider</button>
        </form>
        


        <?php
        // put your code here
        ?>
        <h1>Inscription</h1>
        <form type="POST" name="register">
            Nom : <input name='name_user' type="text" placeholder="Nom"><br>
            Prénom : <input name='firstname_user' type="text" placeholder="Prénom"><br>
            Pseudo : <input name='pseudo_user' type="text" placeholder="Pseudo"><br>
            Email : <input name='email_user' type="text" placeholder="Email"><br>
            Mdp : <input name='password_user' type="password" placeholder="Votre mdp" >
            <button type="post" value="valider" name="btnRegister">Valider</button>
        </form>
        <?php
        // put your code here
        ?>

        <h1>Modification</h1>


        <form>
            Pseudo <select name="listeDesUsers">Choisissez votre pseudo
                <?php
                foreach ($pseudoUsers as $user) {
                    echo "<option value='$user[0]'>";
                    echo $user[1];
                    echo "</option>";
                }
                ?>
            </select> <br>
            Nom : <input name='name_user' type="text" placeholder="Nom"><br>
            Prénom : <input name='firstname_user' type="text" placeholder="Prénom"><br>
            Email : <input name='email_user' type="text" placeholder="Email"><br>
            Mdp : <input name='password_user' type="password" placeholder="Votre mdp" >
            <button type="post" value="Modifier" name="btnUpdate">Modifier</button>
        </form>
        <h1>Suppression</h1>
        <form>
            Pseudo <select name="listeDesUsers">Choisissez votre pseudo
                <?php
                foreach ($pseudoUsers as $user) {
                    echo "<option value='$user[0]'>";
                    echo $user[1];
                    echo "</option>";
                }
                ?>
                </select>
                <button type="post" value="Delete" name="btnDelete">Supprimer</button>
        </form>
    </body>
</html> 
