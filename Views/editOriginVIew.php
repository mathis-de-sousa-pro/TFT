<?php
$this->layout('template', ['title' => 'Edit Origin']);
?>

<div class="container my-5">
    <div class="row">
        <!-- Colonne de gauche : Sélection de l'origine et formulaire de modification -->
        <div class="col">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white">
                    <h2 class="card-title text-center m-0">Edit Origin</h2>
                </div>
                <div class="card-body">
                    <!-- Sélection de l'origine -->
                    <form action="/TFT/index.php" method="GET" class="mb-4">
                        <input type="hidden" name="action" value="edit-origin">
                        <div class="mb-3">
                            <label for="originSelect" class="form-label">Select Origin to Edit</label>
                            <select class="form-select" id="originSelect" name="originId" onchange="this.form.submit()">
                                <option value="">Choose an origin</option>
                                <?php foreach ($origins as $origin): ?>
                                    <option value="<?= htmlspecialchars($origin->getId()) ?>"
                                        <?= isset($selectedOrigin) && $selectedOrigin->getId() === $origin->getId() ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($origin->getName()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>

                    <!-- Formulaire de modification de l'origine sélectionnée -->
                    <?php if (isset($selectedOrigin)): ?>
                        <form action="/TFT/index.php?action=edit-origin" method="POST">
                            <input type="hidden" name="Id" value="<?= $selectedOrigin ? htmlspecialchars($selectedOrigin->getId()) : '' ?>">

                            <div class="mb-3">
                                <label for="name" class="form-label">Origin Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="<?= htmlspecialchars($selectedOrigin->getName()) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="url_img" class="form-label">Image URL</label>
                                <input type="text" class="form-control" id="url_img" name="url_img"
                                       value="<?= htmlspecialchars($selectedOrigin->getUrlImg()) ?>">
                            </div>

                            <div class="d-flex justify-content-evenly">
                                <button type="submit" class="btn btn-info text-white p-2 fs-4">Confirm Edit</button>
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
        // Vérifie si une origine est sélectionnée et si le formulaire a été soumis
        const selectedOrigin = <?= isset($selectedOrigin) && $selectedOrigin ? 'true' : 'false' ?>;

        if (selectedOrigin) {
            // Scrolle vers le bas si une origine est sélectionnée
            window.scrollTo(0, document.body.scrollHeight);
        }
    });
</script>
