<?php

namespace Controllers\Router\Routes;

use Controllers\AddUnitController;
use Controllers\Router\Route;
use Controllers\UnitController;

class RouteAddUnitOrigin extends Route
{

    private UnitController $uc;

    public function __construct(UnitController $uc)
    {
        $this->uc = $uc;
    }
    public function getRoute(array $params): void
    {
        $this->uc->displayAddUnitOriginWindow($params);
    }

    public function postRoute(array $params): void
    {
        // TODO: Implement postRoute() method.
    }
}