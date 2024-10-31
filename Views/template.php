<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <style>
        .navbar .material-icons,
        .navbar .material-symbols-outlined {
            font-size: 5vw; /* Taille personnalisée pour les icônes */
        }
        .navbar {
            padding: 10px 20px; /* Padding personnalisé pour la barre de navigation */
        }
        /* Bouton de mode fixé en bas à gauche */
        .mode-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
        }
        /* Icône de mode plus grande */
        .mode-icon {
            font-size: 3rem;
        }

        /* Style pour afficher le dropdown en hover vers le haut */
        .dropup .dropdown-menu {
            bottom: 100%; /* Positionner le menu au-dessus du bouton */
            top: auto;    /* Désactiver la position par défaut vers le bas */
        }

        /* Afficher le menu dropdown en hover */
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-bottom: 0;
        }
    </style>

    <title><?= $this->e($title) ?></title>
</head>

<body>
<header>
    <nav class="m-4 mx-5 navbar rounded shadow navbar-expand-lg navbar-light bg-body-secondary">
        <div class="container-fluid">
            <!-- Boutons principaux -->
            <a id="home-btn" class="navbar-brand" href="/TFT/index.php">
                <span class="material-symbols-outlined">home</span>
            </a>
            <a id="add-btn" class="navbar-brand" href="#">
                <span class="material-symbols-outlined">add_box</span>
            </a>
            <a id="search-btn" class="navbar-brand" href="#">
                <span class="material-symbols-outlined">search</span>
            </a>
            <a id="edit-btn" class="navbar-brand" href="#">
                <span class="material-symbols-outlined">edit</span>
            </a>
            <a id="delete-btn" class="navbar-brand" href="#">
                <span class="material-symbols-outlined">delete_forever</span>
            </a>
        </div>
    </nav>
</header>

<!-- Bouton de mode fixé en bas à gauche avec .dropup pour afficher vers le haut -->
<div class="mode-button dropup">
    <div class="dropdown">
        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span id="mode-icon" class="material-symbols-outlined mode-icon">token</span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="#" onclick="setMode('Unit')">
                    <span class="material-symbols-outlined mode-icon">token</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#" onclick="setMode('Origin')">
                    <span class="material-symbols-outlined mode-icon">flag</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- #contenu -->
<main>
    <?=$this->section('content')?>
</main>

<footer></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script>
    // Fonction pour changer et sauvegarder le mode
    function setMode(mode) {
        currentMode = mode;
        const modeIcon = document.getElementById('mode-icon');
        if (mode === 'Unit') {
            modeIcon.textContent = 'token';
        } else {
            modeIcon.textContent = 'flag';
        }
        localStorage.setItem('selectedMode', mode); // Sauvegarde le mode dans le localStorage

        // Mettre à jour les liens des boutons en fonction du mode
        document.getElementById('add-btn').href = `/TFT/index.php?action=add-${mode.toLowerCase()}`;
        document.getElementById('delete-btn').href = `/TFT/index.php?action=delete-${mode.toLowerCase()}`;
        document.getElementById('edit-btn').href = `/TFT/index.php?action=edit-${mode.toLowerCase()}`;
        document.getElementById('search-btn').href = `/TFT/index.php?action=search-${mode.toLowerCase()}`;
    }

    // Charger le mode sauvegardé ou définir "Unit" par défaut
    let currentMode = localStorage.getItem('selectedMode') || 'Unit';
    setMode(currentMode); // Initialisation du mode
</script>
</body>
</html>
