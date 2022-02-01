<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>Liste sélection multiple</title>
    </head>

    <body>
        <form method="get" action="">
            <select multiple='multiple' name='lbVoitures[]' >
                <option value="Alpha">Alpha</option>
                <option value="Fiat">Fiat</option>
                <option value="Peugeot">Peugeot</option>
                <option value="Renault">Renault</option>
                <option value="Mercedes">Mercedes</option>
            </select>
            <br><input type="submit" />
        </form>

        <?php
        // --- listeMultiple.php
        $vals = "";
        $selections = filter_input(INPUT_GET, 'lbVoitures', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($selections != null) {
            $vals = implode("-", $selections);
            echo "Sélections : $vals";
        } else {
            echo "Pas de sélection !";
        }
        ?>
    </body>
</html>

