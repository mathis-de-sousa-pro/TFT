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
                    <label for="unitName" class="form-label">Unit Name</label>
                    <input type="text" class="form-control" id="unitName" name="unitName" placeholder="Enter unit name" aria-label="name">
                </div>

                <div class="mb-3">
                    <label for="unitImageUrl" class="form-label">Image URL</label>
                    <input type="text" class="form-control" id="unitImageUrl" name="unitImageUrl" placeholder="Enter image URL" aria-label="url image">
                </div>

                <div class="mb-3">
                    <label for="unitCost" class="form-label">Cost</label>
                    <input type="range" class="form-range" id="unitCost" name="unitCost" min="1" max="5" step="1">
                    <small class="form-text text-muted">Choose a value between 1 and 5.</small>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success shadow">Add Unit</button>
                </div>
            </form>
        </div>
    </div>
</div>
