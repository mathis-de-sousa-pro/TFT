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
    <div class="col">
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample'
            . $unitId . '" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample'
            . $unitId . '" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }

    public static function createForm()
    {
        return '   
    <div class="container m-5 py-5">
        <div class="form">
            <div class="row">
                <input type="text" class="form-control" placeholder="name" aria-label="name">
            </div>
            <div class="row">
                <input type="text" class="form-control" placeholder="url image" aria-label="url image">
            </div>
            <div class="row">
                <label for="customRange3" class="form-label">cost</label>
                <input type="range" class="form-range" min="1" max="5" step="1" id="customRange3">
            </div>

        </div>
    </div>';
    }
}