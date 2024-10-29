<?php

namespace Views;

class constructor
{
    public static function createAllCards($units): string
    {
        $html = '<div class="row row-cols-1 row-cols-xl-3 row-cols-xxl-5 row-cols-md-2 g-5 m-3">';
        foreach ( $units as $unit )
        {
            $html .= self::createCard($unit);
        }
        $html .= '</div>';
        return $html;
    }

    public static function createCard($unit): string
    {
        // Utilisation des getters de l'objet `Unit` pour obtenir les propriétés
        $imageUrl = htmlspecialchars($unit->getUrlImg());
        $unitId = htmlspecialchars($unit->getId());
        $unitName = htmlspecialchars($unit->getName());
        $unitCost = htmlspecialchars($unit->getCost());
        $unitOrigin = htmlspecialchars($unit->getOrigin());

        return '
    <div class="col align-self-center" style="max-height: 50vw; max-width: 50vw;">
        <div class="card h-100 text-white shadow">
            <img class="card-img" src="' . $imageUrl . '" alt="Card image">
            <div class="card-img-overlay">
                <div class="card-text text-center d-flex align-items-center" style="height: 100%">
                    <div id="carouselExample' . $unitId . '" class="carousel slide flex-fill">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <h1>' . $unitName . '</h1>
                            </div>
                            <div class="carousel-item">
                                <h1>' . $unitCost . '</h1>
                            </div>
                            <div class="carousel-item">
                                <h1>' . $unitOrigin . '</h1>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample' . $unitId . '" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample' . $unitId . '" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }

    public static function createMessageNotification(string $text): string
    {
        // Détecte la présence du mot "erreur" dans le texte pour définir la couleur
        $bgColorClass = stripos($text, 'erreur') !== false ? 'text-bg-danger' : 'text-bg-success';

        return '
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="max-width: 400px;">
          <div id="liveToast" class="toast ' . $bgColorClass . ' border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
            <div class="toast-header ' . $bgColorClass . ' text-white">
              <img src="https://seeklogo.com/images/T/teamfight-tactics-logo-4B66ABB0E4-seeklogo.com.png" class="rounded me-2" style="max-height: 5vw" alt="icon">
              <p class="fs-3">' . htmlspecialchars($text) . '</p>
            </div>
          </div>
        </div>';
    }
}