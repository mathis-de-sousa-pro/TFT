<?php
$this->layout('template', ['title' => 'Search Unit']);
?>

<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title text-center m-0">Search Units</h2>
        </div>

        <div class="card-body">
            <?php if (!isset($searched) || !$searched): ?>
                <!-- Formulaire de recherche -->
                <form action="/TFT/index.php?action=search-unit" method="POST">
                    <div class="mb-3">
                        <label for="searchTerm" class="form-label">Search Term</label>
                        <input type="text" class="form-control" id="searchTerm" name="searchTerm" required placeholder="Enter search term">
                    </div>

                    <div class="mb-3">
                        <label for="searchField" class="form-label">Search Field</label>
                        <select class="form-select" id="searchField" name="searchField">
                            <?php foreach ($unitProperties as $property): ?>
                                <option value="<?= htmlspecialchars($property) ?>">
                                    <?= ucfirst(htmlspecialchars($property)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-evenly">
                        <button type="submit" class="btn btn-primary p-2 fs-4">Search</button>
                    </div>
                </form>
            <?php else: ?>
                <!-- Affichage des résultats de la recherche -->
                <div class="mt-3">
                    <?php if (!empty($tabUnits)): ?>
                        <?= $tabUnits; ?>
                    <?php else: ?>
                        <p class="text-center text-muted">No results found for the search term.</p>
                    <?php endif; ?>
                </div>

                <!-- Lignes de boutons pour nouvelle recherche et retour à l'accueil -->
                <div class="d-flex justify-content-evenly">
                    <a href="/TFT/index.php?action=search-unit" class="btn btn-primary p-2 fs-4">New Search</a>
                    <a href="/TFT/index.php?action=home" class="btn btn-secondary p-2 fs-4">Home</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searched = <?= isset($searched) && $searched ? 'true' : 'false' ?>;

        if (searched) {
            window.scrollTo(0, document.body.scrollHeight);
        }
    });
</script>
