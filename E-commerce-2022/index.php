<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body>
    <?php
    include('navbar.php');
    require('data.php');
    require('contenu.php');
    ?>

    <script>
        let pagination = document.querySelectorAll('.pagination .page-link')

        let params = (new URL(document.location)).searchParams
        let page = params.get('page')

        pagination.forEach(element => {

            if (element.innerText === page) {
                // console.log([element])
                element.parentElement.classList.add('active')
            }
        })        
    </script>

    <script src="searchTable.js"></script>
</body>

</html>