<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteAddUnit extends Route
{

    private UnitController $uc;

    public function __construct(UnitController $uc)
    {
        $this->uc = $uc;
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