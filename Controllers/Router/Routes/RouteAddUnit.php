<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteAddUnit extends Route
{

    private UnitController $uc;

    public function __construct(UnitController $oc)
    {
        $this->uc = $oc;
    }

    public function getRoute(array $params): void
    {
        $this->uc->displayAddUnitWindow();
    }

    public function postRoute(array $params): void
    {
        $this->uc->addUnit($params);
    }
}