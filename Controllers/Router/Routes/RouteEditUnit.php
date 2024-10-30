<?php

namespace Controllers\Router\Routes;

use Controllers\UnitController;
use Controllers\Router\Route;

class RouteEditUnit extends Route
{
    private UnitController $uc;

    public function __construct(UnitController $uc)
    {
        $this->uc = $uc;
    }

    public function getRoute(array $params): void
    {
        // Si un ID d'unité est fourni, affiche le formulaire pré-rempli
        if (isset($params['unitId'])) {
            $this->uc->displayEditUnitWindow($params['unitId']);
        } else {
            // Si aucun `unitId` n'est défini, affiche le formulaire vide avec la liste de sélection
            $this->uc->displayEditUnitWindow();
        }
    }

    public function postRoute(array $params): void
    {
        $this->uc->updateUnit($params);
    }
}
