<?php

$cnx = new PDO('mysql:host=localhost;dbname=my_database;charset=utf8', 'root', '');

$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
$limite = 10;

// Partie "Requête"
$debut = ($page - 1) * $limite;
$query = 'SELECT * FROM `my_table` LIMIT :limite OFFSET :debut';
$query = $cnx->prepare($query);
$query->bindValue('debut', $debut, PDO::PARAM_INT);
$query->bindValue('limite', $limite, PDO::PARAM_INT);
$query->execute();

// Partie "Boucle"
while ($element = $query->fetch()) {
    // C'est là qu'on affiche les données  :)
}
// Partie "Liens"
/* On calcule le nombre de pages */
$nombreDePages = ceil($nombredElementsTotal / $limite);

/* Si on est sur la première page, on n'a pas besoin d'afficher de lien
 * vers la précédente. On va donc ne l'afficher que si on est sur une autre
 * page que la première */
if ($page > 1):
    ?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;

/* On va effectuer une boucle autant de fois que l'on a de pages */
for ($i = 1; $i <= $nombreDePages; $i++):
    ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;

/* Avec le nombre total de pages, on peut aussi masquer le lien
 * vers la page suivante quand on est sur la dernière */
if ($page < $nombreDePages):
    ?>— <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;
?>