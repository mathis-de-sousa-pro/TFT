<?php $this->layout('template', ['title' => 'Home']) ?>

<div class="container">
    <?= $cardsHtml ?>
</div>

<!-- Notification Toast -->
<?= $notificationHtml ?? '' ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElement = document.getElementById('liveToast');
        if (toastElement) {
            const toast = new bootstrap.Toast(toastElement);
            toast.show(); // Affiche automatiquement le toast à l'ouverture de la page
        }
    });
</script>
