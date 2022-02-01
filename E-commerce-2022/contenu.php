<main class="container">
    <div class="bg-light p-5 rounded">
        <h1>Catalogue paginé</h1>
        <p class="lead">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium provident est sit odio possimus quia architecto ipsum voluptatem, laboriosam quam corrupti, quisquam enim animi perferendis accusantium perspiciatis molestiae accusamus inventore.</p>
        <table class="table table-bordered table-striped table-hover mb-4 product-list">
            <thead>
                <tr class="table-primary">
                    <th>Photo</th>
                    <th>Nom produit</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // LES PRODUITS
                $cheminPhotos = "images/";
                foreach ($array as $line) {
                    $photo = ($line["photo"]) ? $line["photo"] : "Pas de photo" ;

                    $photo = ($photo !== "Pas de photo" && file_exists($cheminPhotos . $line["photo"])) ? "<img style='width: 100px;' src='" . $cheminPhotos . $line["photo"] . "' alt=''> " : "Pas de photo disponible" ;
                    
                    echo "<tr>
                        <td>" . $photo . "</td>
                        <td>" . $line["designation"] . "</td>
                        <td>" . number_format($line["prix"], 2, '.', '') . "</td>
                        <td>
                            <form class='btn-group gap-2'>
                                <input type='number' name='qte' value='1' max='" .$line['qte_stockee'] . "' min='1'> 
                                <input type='hidden' name='id_produit' value='" .$line['id_produit'] . "'>
                                <span> /" .$line['qte_stockee'] . " </span>
                                <button title='Ajouter au panier' class='btn btn-sm btn-primary name='action' value'addCart'><i class='bi bi-cart4'></i></button>
                            </form
                        </td>
                    </tr>";
                }
                ?>
            </tbody>             
                   
            <tfoot>
                <tr>
                    <td colspan="4" class="">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item first"> <a class="page-link" href="?page=1">&laquo;</a> </li>

                                <li class="page-item previous"> <a class="page-link" href="?page=<?= ($currentPage == 1) ? $numAnchors : $currentPage - 1 ?>">Previous</a> </li>

                                <div class="d-flex">
                                    <?php for ($i = 0; $i < $numAnchors; $i++) {
                                        $debut = $i + 1;
                                        echo "<li class='page-item'><a class='page-link' href='?page=$debut'>" . ($i + 1) . "</a></li>";
                                    }
                                    ?>
                                </div>

                                <li class="page-item next"> <a class="page-link" href="?page=<?= ($currentPage == $numAnchors) ? 1 : $currentPage + 1 ?>">Next</a> </li>

                                <li class="page-item last"> <a class="page-link" href="?page=<?= $numAnchors ?>">&raquo;</a> </li>
                            </ul>
                        </nav>
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</main>