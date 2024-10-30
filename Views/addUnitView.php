<?php
$this->layout('template', ['title' => 'add-unit']);
?>
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h2 class="card-title text-center m-0">Add a New Unit</h2>
        </div>
        <div class="card-body">
            <form action="/TFT/index.php?action=add-unit" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Unit Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter unit name" aria-label="name" required>
                </div>

                <div class="mb-3">
                    <label for="url_img" class="form-label">Image URL</label>
                    <input type="text" class="form-control" id="url_img" name="url_img" placeholder="Enter image URL" aria-label="url image">
                </div>

                <?= $listOrigins ?>

                <div class="mb-3">
                    <label for="cost" class="form-label">Cost</label>
                    <input type="range" class="form-range" id="cost" name="cost" min="1" max="5" step="1" required>
                    <small class="form-text text-muted">Choose a value between 1 and 5.</small>
                </div>

                <div class="d-flex justify-content-evenly">
                    <button type="submit" class="btn btn-success p-2 fs-4">Add Unit</button>
                    <a href="/TFT/index.php?action=home" class="btn btn-secondary p-2 fs-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
