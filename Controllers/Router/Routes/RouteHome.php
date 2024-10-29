<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;


/**
 * Class RouteHome
 *
 * This class handles the routing for the home page.
 *
 */
class RouteHome extends Route
{
    /**
     * @var MainController $mainController The controller responsible for home page operations.
     */
    private MainController $mainController;

    /**
     * RouteHome constructor.
     *
     * @param MainController $mainController The home controller instance.
     */
    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
    }

    /*
     * Handle GET requests for the home route.
     *
     * @param array $params The parameters for the route.
     * @return void
     */
    public function getRoute(array $params): void
    {
        $this->mainController->index();
    }

    /**
     * Handle POST requests for the home route.
     *
     * @param array $params The parameters for the route.
     * @return void
     */
    public function postRoute(array $params): void
    {
        // TODO: Implement postRoute() method.
    }
}