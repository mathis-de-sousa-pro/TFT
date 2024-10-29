<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteSearch extends Route
{

    private UnitController $uc;

    public function __construct(UnitController $sc)
    {
        $this->uc = $sc;
    }

    /**
     * @inheritDoc
     */
    public function getRoute(array $params): void
    {
        $this->uc->displaySearchView();
    }

    /**
     * @inheritDoc
     */
    public function postRoute(array $params): void
    {
        var_dump($params);
        echo "unit searched";
    }
}