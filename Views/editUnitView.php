<?php
$this->layout('template', ['title' => 'Edit Unit']);
?>

<div class="container my-5">
    <div class="row">
        <!-- Colonne de gauche : Sélection de l'unité et formulaire de modification -->
        <div class="col">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h2 class="card-title text-center m-0">Edit Unit</h2>
                </div>
                <div class="card-body">
                    <!-- Sélection de l'unité -->
                    <form action="/TFT/index.php" method="GET" class="mb-4">
                        <input type="hidden" name="action" value="edit-unit">
                        <div class="mb-3">
                            <label for="unitSelect" class="form-label">Select Unit to Edit</label>
                            <select class="form-select" id="unitSelect" name="unitId" onchange="this.form.submit()">
                                <option value="">Choose a unit</option>
                                <?php foreach ($units as $unit): ?>
                                    <option value="<?= htmlspecialchars($unit->getId()) ?>"
                                        <?= isset($selectedUnit) && $selectedUnit->getId() === $unit->getId() ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($unit->getName()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>

                    <!-- Formulaire de modification de l'unité sélectionnée -->
                    <?php if (isset($selectedUnit)): ?>
                        <form action="/TFT/index.php?action=edit-unit" method="POST">
                            <input type="hidden" name="Id" value="<?= $selectedUnit ? htmlspecialchars($selectedUnit->getId()) : '' ?>">

                            <div class="mb-3">
                                <label for="name" class="form-label">Unit Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="<?= htmlspecialchars($selectedUnit->getName()) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control" id="cost" name="cost"
                                       value="<?= htmlspecialchars($selectedUnit->getCost()) ?>" min="1" max="5" required>
                            </div>

                            <?= $listOrigins ?>

                            <div class="mb-3">
                                <label for="url_img" class="form-label">Image URL</label>
                                <input type="text" class="form-control" id="url_img" name="url_img"
                                       value="<?= htmlspecialchars($selectedUnit->getUrlImg()) ?>" required>
                            </div>

                            <div class="d-flex justify-content-evenly">
                                <button type="submit" class="btn btn-warning text-white p-2 fs-4">Confirm Edit</button>
                                <a href="/TFT/index.php?action=home" class="btn btn-secondary p-2 fs-4">Cancel</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Vérifie si un élément est sélectionné et si le formulaire a été soumis
        const selectedUnit = <?= isset($selectedUnit) && $selectedUnit ? 'true' : 'false' ?>;

        if (selectedUnit) {
            // Scrolle vers le bas si une unité est sélectionnée
            window.scrollTo(0, document.body.scrollHeight);
        }
    });
</script>