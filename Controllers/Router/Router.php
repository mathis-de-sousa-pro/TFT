<?php

namespace Controllers\Router;

use Controllers\OriginController;
use Controllers\Router\Routes\RouteDeleteOrigin;
use Controllers\Router\Routes\RouteDeleteUnit;
use Controllers\Router\Routes\RouteEditOrigin;
use Controllers\Router\Routes\RouteSearchOrigin;
use Controllers\UnitController;
use Controllers\MainController;
use Controllers\Router\Routes\RouteAddUnit;
use Controllers\Router\Routes\RouteAddUnitOrigin;
use Controllers\Router\Routes\RouteEditUnit;
use Controllers\Router\Routes\RouteHome;
use Controllers\Router\Routes\RouteSearchUnit;

/**
 * Classe Router
 *
 * Cette classe gère la logique de routage pour l'application.
 */
class Router
{
    /**
     * @var array $routeList
     * Liste des routes.
     */
    private array $routeList;

    /**
     * @var array $ctrlList
     * Liste des contrôleurs.
     */
    private array $ctrlList;

    /**
     * @var string $action_key
     * Clé pour l'action en cours.
     */
    private string $action_key;

    /**
     * Constructeur
     *
     * Initialise le routeur avec une clé d'action par défaut.
     *
     */
    public function __construct()
    {
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Crée la liste des contrôleurs.
     *
     * Initialise la liste des contrôleurs.
     *
     * @return void
     */
    private function createControllerList(): void
    {
        $this->ctrlList = [
            "main" => new MainController(),
            "unit" => new UnitController(),
            "origin" => new OriginController()
        ];
    }

    /**
     * Crée la liste des routes.
     *
     * Initialise la liste des routes.
     *
     * @return void
     */
    private function createRouteList(): void
    {
        $this->routeList = [
            // main
            "home" => new RouteHome($this->ctrlList["main"]),

            // unit
            "add-unit" => new RouteAddUnit($this->ctrlList["unit"]),
            "edit-unit" => new RouteEditUnit($this->ctrlList["unit"]),
            "delete-unit" => new RouteDeleteUnit($this->ctrlList["unit"]),
            "search-unit" => new RouteSearchUnit($this->ctrlList["unit"]),

            // origin
            "add-origin" => new RouteAddUnitOrigin($this->ctrlList["origin"]),
            "edit-origin" => new RouteEditOrigin($this->ctrlList["origin"]),
            "delete-origin" => new RouteDeleteOrigin($this->ctrlList["origin"]),
            "search-origin" => new RouteSearchOrigin($this->ctrlList["origin"])
        ];
    }

    /**
     * Détermine la route à appeler via $_GET ou $_POST.
     *
     * Route la requête vers le gestionnaire approprié en fonction de la méthode HTTP.
     *
     * @param array $get
     * Les paramètres de la méthode $_GET.
     * @param array $post
     * Les paramètres de la méthode $_POST.
     *
     * @return void
     */
    public function routing(array $get, array $post): void
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET') {
            if (isset($get["action"])) {
                $this->action_key = $get["action"];
                $this->routeList[$this->action_key]->getRoute($get);
            } else {
                $this->routeList["home"]->getRoute($get);
            }
        } else {
            if (isset($get["action"])) {
                $this->action_key = $get["action"];
                $this->routeList[$this->action_key]->postRoute($post);
            }
        }
    }
}
