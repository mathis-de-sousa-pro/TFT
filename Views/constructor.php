<?php

namespace Views;

use Models\Managers\OriginManager;
use Models\Origin;
use Models\Unit;

class constructor
{
    public static function createAllSearchedUnitCards(array $units): string
    {
        $html = '<div class="row row-cols-2 row-cols-xl-3 row-cols-xxl-5 row-cols-md-2 g-5 m-3">';
        foreach ( $units as $unit )
        {
            $html .= self::createSearchedUnitCard($unit);
        }
        $html .= '</div>';
        return $html;
    }

    public static function createAllSearchedOriginCards(array $origins): string
    {
        $html = '<div class="row row-cols-2 row-cols-xl-3 row-cols-xxl-5 row-cols-md-2 g-5 m-3">';
        foreach ( $origins as $origin )
        {
            $html .= self::createSearchedOriginCard($origin);
        }
        $html .= '</div>';
        return $html;
    }

    public static function createAllUnitCards(array $units): string
    {
        $html = '<div class="row row-cols-2 row-cols-xl-3 row-cols-xxl-5 row-cols-md-2 g-5 m-3">';
        foreach ( $units as $unit )
        {
            $html .= self::createUnitCard($unit);
        }
        $html .= '</div>';
        return $html;
    }

    public static function createUnitCard(Unit $unit, OriginManager $originManager = new OriginManager()): string
    {
        $imageUrl = htmlspecialchars($unit->getUrlImg());
        $unitId = htmlspecialchars($unit->getId());
        $unitName = htmlspecialchars($unit->getName());
        $unitCost = htmlspecialchars($unit->getCost());
        $origins = $unit->getOrigins();

        $originDropdownItems = '';
        foreach ($origins as $originId) {
            $origin = $originManager->get($originId);
            if ($origin) {
                $originName = htmlspecialchars($origin->getName());
                $originDropdownItems .= '<li><span class="dropdown-item">' . $originName . '</span></li>';
            }
        }

        return '
    <div class="col align-self-center">
        <div class="card h-100 text-white shadow">
            <img class="card-img" src="' . $imageUrl . '" alt="Card image">
            <div class="card-img-overlay">
                <div class="card-text text-center d-flex align-items-center" style="height: 100%">
                    <div id="carouselExample' . $unitId . '" class="carousel slide flex-fill">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <!-- Image de fond sans texte -->
                            </div>
                            <div class="carousel-item">
                                <div class="d-flex justify-content-between align-items-center rounded bg-success shadow p-2 mb-2">
                                    <span class="material-symbols-outlined">id_card</span>
                                    <span class="text-end fs-3">' . $unitName . '</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center rounded bg-warning shadow p-2 mb-2">
                                    <span class="material-symbols-outlined">paid</span>
                                    <span class="text-end fs-3">' . $unitCost . '</span>
                                </div>
                                <div class="dropdown" data-bs-theme="dark">
                                    <button class="btn btn-secondary dropdown-toggle material-symbols-outlined" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        flag
                                    </button>
                                    <ul class="dropdown-menu">' .
            $originDropdownItems .
            '</ul>
                                </div>
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

    public static function createOriginCard(Origin $origin): string
    {
        // Utilisation des getters de l'objet `Origin` pour obtenir les propriétés
        $imageUrl = htmlspecialchars($origin->getUrlImg());
        $originId = htmlspecialchars($origin->getId());
        $originName = htmlspecialchars($origin->getName());

        return '
        <div class="col align-self-center">
            <div class="card h-100 text-white shadow">
                <img class="card-img" src="' . $imageUrl . '" alt="Origin image">
                <div class="card-img-overlay">
                    <div class="card-text text-center d-flex align-items-center" style="height: 100%">
                        <div id="carouselExample' . $originId . '" class="carousel slide flex-fill">
                            <div class="carousel-inner">
                                <div class="carousel-item active"></div>
    
                                <div class="carousel-item">
                                    <div class="d-flex justify-content-center align-items-center rounded bg-primary shadow p-2">
                                        <span class="fs-3">' . $originName . '</span>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample' . $originId . '" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample' . $originId . '" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    public static function createSearchedUnitCard(Unit $unit): string
    {
        // Utilisation des getters de l'objet `Unit` pour obtenir les propriétés
        $imageUrl = htmlspecialchars($unit->getUrlImg());
        $unitId = htmlspecialchars($unit->getId());
        $unitName = htmlspecialchars($unit->getName());
        $unitCost = htmlspecialchars($unit->getCost());

        return '
    <div class="col my-5">
        <div class="card h-100 text-white shadow">
            <img class="card-img" src="' . $imageUrl . '" alt="Card image">
            <div class="card-img-overlay">
                <div class="card-text text-center d-flex align-items-center" style="height: 100%">
                    <div id="carouselExample' . $unitId . '" class="carousel slide flex-fill">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <!-- Image de fond sans texte -->
                            </div>
                            <div class="carousel-item">
                                <div class="d-flex justify-content-between align-items-center rounded bg-success shadow p-2 mb-2">
                                    <span class="material-symbols-outlined">id_card</span>
                                    <span class="text-end fs-3">' . $unitName . '</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center rounded bg-warning shadow p-2 mb-2">
                                    <span class="material-symbols-outlined">paid</span>
                                    <span class="text-end fs-3">' . $unitCost . '</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-evenly rounded p-2 mb-2">
                                    <a class="material-symbols-outlined btn btn-warning" href="/TFT/index.php?action=edit-unit&unitId=' . $unitId . '">edit</a>
                                    <a class="material-symbols-outlined btn btn-danger" href="/TFT/index.php?action=delete-unit&unitId=' . $unitId . '">delete_forever</a>
                                </div>
                                
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

    public static function createSearchedOriginCard(Origin $origin): string
    {
        $imageUrl = htmlspecialchars($origin->getUrlImg());
        $originId = htmlspecialchars($origin->getId());
        $originName = htmlspecialchars($origin->getName());

        return '
    <div class="col my-5">
        <div class="card h-100 text-white shadow">
            <img class="card-img" src="' . $imageUrl . '" alt="Origin image">
            <div class="card-img-overlay">
                <div class="card-text text-center d-flex align-items-center" style="height: 100%">
                    <div id="carouselExample' . $originId . '" class="carousel slide flex-fill">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            </div>
                            <div class="carousel-item">
                                <div class="d-flex justify-content-center align-items-center rounded bg-primary shadow p-2 mb-2">
                                    <span class="fs-3">' . $originName . '</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-evenly rounded p-2 mb-2">
                                    <a class="material-symbols-outlined btn btn-warning" href="/TFT/index.php?action=edit-origin&originId=' . $originId . '">edit</a>
                                    <a class="material-symbols-outlined btn btn-danger" href="/TFT/index.php?action=delete-origin&originId=' . $originId . '">delete_forever</a>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample' . $originId . '" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample' . $originId . '" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }

    public static function createOriginSelection(array $origins, array $selectedOrigins = []): string
    {
        $html = '
    <div class="mb-3">
        <div class="accordion border rounded" id="accordionOrigins">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOrigins">
                    <button class="accordion-button collapsed btn-warning text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrigins" aria-expanded="false" aria-controls="collapseOrigins">
                        Select Origins
                    </button>
                </h2>
                <div id="collapseOrigins" class="accordion-collapse collapse" aria-labelledby="headingOrigins" data-bs-parent="#accordionOrigins">
                    <div class="accordion-body">';

        foreach ($origins as $origin) {
            $id = htmlspecialchars($origin->getId());
            $name = htmlspecialchars($origin->getName());
            $isChecked = '';
            foreach ($selectedOrigins as $selectedOrigin) {
                if ($selectedOrigin->getId() === (int) $id) {
                    $isChecked = 'checked';
                    break;
                }
            }

            $html .= '
        <div class="form-check form-check-inline">
            <input type="checkbox" class="btn-check" id="btn-check-' . $id . '" name="origins[]" value="' . $id . '" ' . $isChecked . ' autocomplete="off">
            <label class="btn btn-outline-success mb-1" for="btn-check-' . $id . '">' . $name . '</label>
        </div>';
        }


        $html .= '
                    </div>
                </div>
            </div>
        </div>
    </div>';

        return $html;
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