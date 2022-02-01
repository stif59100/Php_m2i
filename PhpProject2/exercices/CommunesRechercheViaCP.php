<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CommunesRechercheViaCP
    </title>
</head>

<body>
    <form>
        CP : <input type="text" name="cp" value="" placeholder="CP ?">
        <input type="submit" value="Valider" name="btSubmit" />
    </form>

    <?php
        $contenu = "";
        $cp = filter_input(INPUT_GET, "cp");
        if ($cp != null) {
            $fichier = "../ressources/insee.csv";

// Si le fichier n'existe pas
            if (file_exists($fichier)) {
                try {
                    // Ouverture pour lecture
                    $canal = fopen($fichier, "r");
                    // Lecture du fichier
                    // Test jusqu'a la fin du fichier
                    while (!feof($canal)) {
                        $ligne = fgets($canal);
                        if (trim($ligne != "")) {
                            $tLigne = explode(";", $ligne);
                            $Codepos = $tLigne[1];
                            if ($Codepos === $cp) {
                                $contenu .= "$tLigne[0]<br>\n";
                            } /// if égalité
                        } /// if trim
                    } /// while
                    // Fermeture du fichier
                    fclose($canal);
                } catch (Exception $e) {
                    $contenu = $e->getMessage();
                }
            } else {
                $contenu = "Le fichier $fichier n'existe pas !";
            }
        }
// Affichage
        echo $contenu;

    ?>
</body>

</html>