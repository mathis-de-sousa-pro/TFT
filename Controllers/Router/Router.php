<?php

namespace Controllers\Router;

use Controllers\AddUnitController;
use Controllers\Router\Routes\RouteDelete;
use Controllers\UnitController;
use Controllers\MainController;
use Controllers\Router\Routes\RouteAddUnit;
use Controllers\Router\Routes\RouteAddUnitOrigin;
use Controllers\Router\Routes\RouteEditUnit;
use Controllers\Router\Routes\RouteHome;
use Controllers\Router\Routes\RouteSearch;
use Controllers\SearchController;

/**
 * Class Router
 *
 * This class handles the routing logic for the application.
 *
 */
class Router
{

    /**
     * @var array $routeList List of routes.
     */
    private array $routeList;

    /**
     * @var array $ctrlList List of controllers.
     */
    private array $ctrlList;

    /**
     * @var string $action_key The key for the current action.
     */
    private string $action_key;

    /**
     * Constructor
     *
     * Initializes the router with a default action key.
     *
     * @param string $nameOfAction The name of the action key (default is "action").
     * @return void
     */
    public function __construct(string $nameOfAction = "action")
    {
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Create a Controller in the list
     *
     * Initializes the list of controllers.
     *
     * @return void
     */
    private function createControllerList(): void
    {
        $this->ctrlList = [
            "main" => new MainController(),
            "unit" => new UnitController()
        ];
    }

    /**
     * Create a route in the list
     *
     * Initializes the list of routes.
     *
     * @return void
     */
    private function createRouteList(): void
    {
        $this->routeList = [
            "home" => new RouteHome($this->ctrlList["main"]),
            "add-unit" => new RouteAddUnit($this->ctrlList["unit"]),
            "add-unit-origin" => new RouteAddUnitOrigin($this->ctrlList["unit"]),
            "edit-unit" => new RouteEditUnit($this->ctrlList["unit"]),
            "search" => new RouteSearch($this->ctrlList["unit"]),
            "delete-unit" => new RouteDelete($this->ctrlList["unit"]) // Modifier ici
            ];
    }

    /**
     * Determines the route to call by $_GET or $_POST
     *
     * Routes the request to the appropriate handler based on the HTTP method.
     *
     * @param array $get The $_GET method parameters.
     * @param array $post The $_POST method parameters.
     * @return void
     */
    public function routing(array $get, array $post): void
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET')
        {
            if (isset($get["action"]))
            {
                $this->action_key = $get["action"];
                $this->routeList[$this->action_key]->getRoute($get);
            }
            else
            {
                $this->routeList["home"]->getRoute($get);
            }
        }
        else
        {
            if (isset($get["action"]))
            {
                $this->action_key = $get["action"];
                $this->routeList[$this->action_key]->postRoute($post);
            }
        }
    }

    /**
     * Get the action key
     *
     * Returns the action key.
     *
     * @return string The action key.
     * @access public
     * @return string
     */
    public function getActionKey(): string
    {
        return $this->action_key;
    }
}