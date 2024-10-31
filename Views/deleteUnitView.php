    <?php
    $this->layout('template', ['title' => 'Delete Unit']);
    ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Colonne de gauche : Formulaire de suppression -->
            <div class="<?= isset($selectedUnit) && $selectedUnit ? 'col-md-6' : 'col' ?>">
                <div class="card shadow-lg border-danger-emphasis">
                    <div class="card-header bg-danger text-white">
                        <h2 class="card-title text-center m-0">Delete Unit</h2>
                    </div>
                    <div class="card-body">
                        <!-- Sélection de l'élément à supprimer -->
                        <form action="/TFT/index.php" method="GET" class="mb-4">
                            <input type="hidden" name="action" value="delete-unit">
                            <div class="mb-3">
                                <label for="itemSelect" class="form-label">Select Unit to Delete</label>
                                <select class="form-select" id="itemSelect" name="unitId" onchange="this.form.submit()">
                                    <option value="">Choose an unit</option>
                                    <?php foreach ($units as $unit): ?>
                                        <option value="<?= htmlspecialchars($unit->getId()) ?>"
                                            <?= isset($_GET['unitId']) && $_GET['unitId'] == $unit->getId() ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($unit->getName()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </form>

                        <?php if (isset($selectedUnit) && $selectedUnit): ?>
                            <!-- Lien de confirmation pour supprimer l'élément sélectionné -->
                            <div class="mt-4 text-center">
                                <p class="text-danger-emphasis">
                                    Are you sure you want to delete this unit? This action cannot be undone.
                                </p>
                                <a href="/TFT/index.php?action=delete-unit&confirmDelete=true&unitId=<?= htmlspecialchars($selectedUnit->getId()) ?>"
                                   class="btn btn-danger mx-5">Yes, Delete</a>
                                <a href="/TFT/index.php?action=home" class="btn btn-secondary mx-5">Cancel</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Affichage de la carte de l'élément sélectionné -->
            <?php if (isset($selectedUnit) && $selectedUnit): ?>
                <div class="col-md-6">
                    <div>
                        <?= \Views\constructor::createCard($selectedUnit) ?>
                    </div>
                </div>
            <?php endif; ?>
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


