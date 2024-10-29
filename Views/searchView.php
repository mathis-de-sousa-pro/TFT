<?php
$this->layout('template', ['title' => 'Search Unit']);
?>
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title text-center m-0">Search Units</h2>
        </div>
        <div class="card-body">
            <form action="/TFT/index.php?action=search" method="POST">
                <!-- Champ texte pour le terme de recherche -->
                <div class="mb-3">
                    <label for="searchTerm" class="form-label">Search Term</label>
                    <input type="text" class="form-control" id="searchTerm" name="searchTerm" placeholder="Enter search term">
                </div>

                <!-- Champ select pour choisir la propriété de recherche -->
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

                <!-- Bouton de soumission -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary shadow">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
