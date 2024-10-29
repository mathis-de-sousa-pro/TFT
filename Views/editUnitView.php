<?php
$this->layout('template', ['title' => 'Edit Unit']);
?>

<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h2 class="card-title text-center m-0">Edit Unit</h2>
        </div>
        <div class="card-body">
            <!-- Sélection de l'unité à modifier -->
            <form action="/TFT/index.php?action=edit-unit" method="GET">
                <div class="mb-3">
                    <label for="unitSelect" class="form-label">Select Unit</label>
                    <select class="form-select" id="unitSelect" name="unitId" onchange="this.form.submit()">
                        <option value="">Choose a unit to edit</option>
                        <?php foreach ($units as $unit): ?>
                            <option value="<?= htmlspecialchars($unit->getId()) ?>"
                                <?= $selectedUnit && $selectedUnit->getId() === $unit->getId() ? 'selected' : '' ?>>
                                <?= htmlspecialchars($unit->getName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>

            <!-- Formulaire de modification de l'unité sélectionnée -->
            <?php if ($selectedUnit): ?>
                <form action="/TFT/index.php?action=edit-unit" method="POST">
                    <input type="hidden" name="unitId" value="<?= htmlspecialchars($selectedUnit->getId()) ?>">

                    <div class="mb-3">
                        <label for="unitName" class="form-label">Unit Name</label>
                        <input type="text" class="form-control" id="unitName" name="unitName"
                               value="<?= htmlspecialchars($selectedUnit->getName()) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="unitOrigin" class="form-label">Origin</label>
                        <input type="text" class="form-control" id="unitOrigin" name="unitOrigin"
                               value="<?= htmlspecialchars($selectedUnit->getOrigin()) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="unitCost" class="form-label">Cost</label>
                        <input type="number" class="form-control" id="unitCost" name="unitCost"
                               value="<?= htmlspecialchars($selectedUnit->getCost()) ?>" min="1" max="5" required>
                    </div>

                    <div class="mb-3">
                        <label for="unitImageUrl" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="unitImageUrl" name="unitImageUrl"
                               value="<?= htmlspecialchars($selectedUnit->getUrlImg()) ?>" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning shadow">Update Unit</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
