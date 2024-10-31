<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;
use Controllers\UnitController;
use Models\Unit;

class RouteDeleteUnit extends Route
{
    private UnitController $uc;
    public function __construct(UnitController $oc)
    {
        $this->uc = $oc;
    }

    public function getRoute(array $params): void
    {
        // Vérifie la présence de `confirmDelete` pour déclencher la suppression
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true') {
            $this->uc->deleteUnit($params);
        } else {
            $this->uc->displayDeleteUnitView($params);
        }
    }

    public function postRoute(array $params): void
    {
        $this->uc->deleteUnit($params);
    }
}