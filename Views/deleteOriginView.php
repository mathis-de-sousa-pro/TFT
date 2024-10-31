<?php
$this->layout('template', ['title' => 'Delete Origin']);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Colonne de gauche : Formulaire de suppression -->
        <div class="<?= isset($selectedOrigin) && $selectedOrigin ? 'col-md-6' : 'col' ?>">
            <div class="card shadow-lg border-danger-emphasis">
                <div class="card-header bg-danger text-white">
                    <h2 class="card-title text-center m-0">Delete Origin</h2>
                </div>
                <div class="card-body">
                    <!-- Sélection de l'élément à supprimer -->
                    <form action="/TFT/index.php" method="GET" class="mb-4">
                        <input type="hidden" name="action" value="delete-origin">
                        <div class="mb-3">
                            <label for="originSelect" class="form-label">Select Origin to Delete</label>
                            <select class="form-select" id="originSelect" name="originId" onchange="this.form.submit()">
                                <option value="">Choose an origin</option>
                                <?php foreach ($origins as $origin): ?>
                                    <option value="<?= htmlspecialchars($origin->getId()) ?>"
                                        <?= isset($_GET['originId']) && $_GET['originId'] == $origin->getId() ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($origin->getName()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>

                    <?php if (isset($selectedOrigin) && $selectedOrigin): ?>
                        <!-- Lien de confirmation pour supprimer l'élément sélectionné -->
                        <div class="mt-4 text-center">
                            <p class="text-danger-emphasis">
                                Are you sure you want to delete this origin? This action cannot be undone.
                            </p>
                            <a href="/TFT/index.php?action=delete-origin&confirmDelete=true&originId=<?= htmlspecialchars($selectedOrigin->getId()) ?>"
                               class="btn btn-danger mx-5">Yes, Delete</a>
                            <a href="/TFT/index.php?action=home" class="btn btn-secondary mx-5">Cancel</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Colonne de droite : Affichage de la carte de l'élément sélectionné -->
        <?php if (isset($selectedOrigin) && $selectedOrigin): ?>
            <div class="col-md-6">
                <div>
                    <?= \Views\constructor::createOriginCard($selectedOrigin) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Vérifie si un élément est sélectionné et si le formulaire a été soumis
        const selectedOrigin = <?= isset($selectedOrigin) && $selectedOrigin ? 'true' : 'false' ?>;

        if (selectedOrigin) {
            // Scrolle vers le bas si une origine est sélectionnée
            window.scrollTo(0, document.body.scrollHeight);
        }
    });
</script>
