<?php
$this->layout('template', ['title' => 'Add Origin']);
?>

<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white">
            <h2 class="card-title text-center m-0">Add New Origin</h2>
        </div>
        <div class="card-body">
            <form action="/TFT/index.php?action=add-unit-origin" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Origin Name</label>
                    <input type="text" class="form-control border-success-emphasis" id="name" name="name" placeholder="Enter origin name" required>
                </div>

                <div class="mb-3">
                    <label for="url_img" class="form-label">Origin Url image</label>
                    <input class="form-control border-success-emphasis" id="url_img" name="url_img" placeholder="Enter image url" required>
                </div>

                <div class="my-3 d-flex justify-content-evenly">
                    <button type="submit" class="btn btn-info text-white p-2 fs-4">Add Origin</button>
                    <a href="/TFT/index.php?action=home" class="btn btn-secondary p-2 fs-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
