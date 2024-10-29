<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;
use Controllers\UnitController;
use Models\Unit;

class RouteDelete extends Route
{
    private UnitController $uc;
    private MainController $mc;
    public function __construct(UnitController $uc)
    {
        $this->uc = $uc;
        $this->mc = new MainController();
    }

    public function getRoute(array $params): void
    {
        // Vérifie la présence de `confirmDelete` pour déclencher la suppression
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true') {
            $this->uc->deleteUnit($params);
        } else {
            $this->uc->displayDeleteView($params);
        }
    }

    public function postRoute(array $params): void
    {
        $this->uc->deleteUnit($params);
        $this->mc->index();
    }
}