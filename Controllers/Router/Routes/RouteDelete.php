<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteDelete extends Route
{
    private UnitController $uc;
    public function __construct(UnitController $uc)
    {
        $this->uc = $uc;
    }

    public function getRoute(array $params): void
    {
        $this->uc->displayDeleteView($params);
    }

    public function postRoute(array $params): void
    {
        // TODO: Implement postRoute() method.
    }
}