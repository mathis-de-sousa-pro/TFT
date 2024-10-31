<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;

/**
 * Classe RouteHome
 *
 * Cette classe gère le routage pour la page d'accueil.
 */
class RouteHome extends Route
{
    /**
     * @var MainController $mainController
     * Le contrôleur responsable des opérations de la page d'accueil.
     */
    private MainController $mainController;

    /**
     * Constructeur de la classe RouteHome.
     *
     * @param MainController $mainController
     * L'instance du contrôleur de la page d'accueil.
     */
    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
    }

    /**
     * Gère les requêtes GET pour la route de la page d'accueil.
     *
     * @param array $params
     * Les paramètres pour la route.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        $this->mainController->index();
    }

    /**
     * Gère les requêtes POST pour la route de la page d'accueil.
     *
     * @param array $params
     * Les paramètres pour la route.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        // TODO: Implémenter la méthode postRoute().
    }
}
