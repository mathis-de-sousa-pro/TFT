<?php

namespace Controllers\Router\Routes;

use Controllers\UnitController;
use Controllers\Router\Route;

class RouteEditUnit extends Route
{

    private UnitController $uc;

    public function __construct(UnitController $euc)
    {
        $this->uc = $euc;
    }

    public function getRoute(array $params): void
    {
        // Si un ID d'unité est fourni, affiche le formulaire de modification avec les données de l'unité
        if (isset($params['unitId'])) {
            $this->uc->displayEditUnitView($params['unitId']);
        } else {
            // Sinon, affiche la liste des unités pour en sélectionner une
            $this->uc->displayUnitSelectionView();
        }
    }

    public function postRoute(array $params): void
    {
        // Met à jour l'unité avec les données du formulaire de modification
        $this->uc->updateUnit($params);
    }
}