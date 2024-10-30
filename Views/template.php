<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../public/css/caret.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        /* Custom styles for larger icons and navbar padding */
        .navbar .material-icons,
        .navbar .material-symbols-outlined {
            font-size: 5vw; /* Taille personnalisée pour les icônes */

        }

        .navbar {
            padding: 10px 20px; /* Padding personnalisé pour la barre de navigation */
        }
    </style>
    <title><?= $this->e($title) ?></title>
</head>

<body>
<header>
    <nav class="m-4 mx-5 navbar rounded shadow navbar-expand-lg navbar-light bg-body-secondary ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/TFT/index.php">
                <span class="material-symbols-outlined"> home </span>
            </a>
            <a class="navbar-brand" href="/TFT/index.php?action=add-unit-origin">
                <span class="material-symbols-outlined">library_add</span>
            </a>
            <a class="navbar-brand" href="/TFT/index.php?action=search">
                <span class="material-symbols-outlined">search</span>
            </a>
            <a class="navbar-brand" href="/TFT/index.php?action=add-unit">
                <span class="material-symbols-outlined">add_box</span>
            </a>
            <a class="navbar-brand" href="/TFT/index.php?action=edit-unit">
                <span class="material-symbols-outlined">edit</span>
            </a>
            <a class="navbar-brand" href="/TFT/index.php?action=delete-unit">
                <span class="material-symbols-outlined">delete_forever</span>
            </a>

        </div>
    </nav>
</header>

<!-- #contenu -->
<main>
    <?=$this->section('content')?>
</main>

<footer>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>
</html>
