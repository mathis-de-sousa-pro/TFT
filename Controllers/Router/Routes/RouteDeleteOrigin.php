<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\OriginController;
use Controllers\Router\Route;
use Controllers\UnitController;
use Models\Unit;

class RouteDeleteOrigin extends Route
{
    private OriginController $oc;
    public function __construct(OriginController $oc)
    {
        $this->oc = $oc;
    }

    public function getRoute(array $params): void
    {
        // Vérifie la présence de `confirmDelete` pour déclencher la suppression
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true') {
            $this->oc->deleteOrigin($params);
        } else {
            $this->oc->displayDeleteOriginView($params);
        }
    }

    public function postRoute(array $params): void
    {
        $this->oc->deleteOrigin($params);
    }
}