<?php
$this->layout('template', ['title' => 'Add Origin']);
?>

<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white">
            <h2 class="card-title text-center m-0">Add New Origin</h2>
        </div>
        <div class="card-body">
            <form action="/TFT/index.php?action=add-origin" method="POST">
                <div class="mb-3">
                    <label for="originName" class="form-label">Origin Name</label>
                    <input type="text" class="form-control border-success-emphasis" id="originName" name="originName" placeholder="Enter origin name" required>
                </div>

                <div class="mb-3">
                    <label for="originDescription" class="form-label">Description</label>
                    <textarea class="form-control border-success-emphasis" id="originDescription" name="originDescription" rows="3" placeholder="Enter a description" required></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info shadow">Add Origin</button>
                </div>
            </form>
        </div>
    </div>
</div>
