<?php

namespace Controllers\Router\Routes;

use Controllers\OriginController;
use Controllers\UnitController;
use Controllers\Router\Route;

class RouteEditOrigin extends Route
{
    private OriginController $oc;

    public function __construct(OriginController $oc)
    {
        $this->oc = $oc;
    }

    public function getRoute(array $params): void
    {
        // Si un ID d'unité est fourni, affiche le formulaire pré-rempli
        if (isset($params['originId'])) {
            $this->oc->displayEditUnitWindow($params['originId']);
        } else {
            // Si aucun `unitId` n'est défini, affiche le formulaire vide avec la liste de sélection
            $this->oc->displayEditUnitWindow();
        }
    }

    public function postRoute(array $params): void
    {
        $this->oc->updateOrigin($params);
    }
}
