<?php

namespace Controllers\Router\Routes;

use Controllers\AddUnitController;
use Controllers\OriginController;
use Controllers\Router\Route;
use Controllers\UnitController;
use Models\Origin;

class RouteAddUnitOrigin extends Route
{

    private OriginController $oc;

    public function __construct(OriginController $oc)
    {
        $this->oc = $oc;
    }
    public function getRoute(array $params): void
    {
        $this->oc->displayAddUnitOriginWindow($params);
    }

    public function postRoute(array $params): void
    {
        $this->oc->addOrigin($params);
    }
}