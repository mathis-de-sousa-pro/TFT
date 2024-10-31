<?php

namespace Controllers\Router\Routes;

use Controllers\OriginController;
use Controllers\Router\Route;

/**
 * Classe RouteAddUnitOrigin
 *
 * Cette classe représente une route pour ajouter une origine d'unité.
 * Elle gère les requêtes GET et POST en utilisant le contrôleur des origines (OriginController).
 */
class RouteAddUnitOrigin extends Route
{
    /**
     * @var OriginController $oc
     * Instance du contrôleur des origines pour gérer les opérations liées aux origines.
     */
    private OriginController $oc;

    /**
     * Constructeur de la classe RouteAddUnitOrigin.
     *
     * @param OriginController $oc
     * Le contrôleur des origines utilisé pour gérer les requêtes de la route.
     */
    public function __construct(OriginController $oc)
    {
        $this->oc = $oc;
    }

    /**
     * Méthode pour gérer une requête GET.
     *
     * @param array $params
     * Les paramètres passés à la route.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        $this->oc->displayAddUnitOriginWindow();
    }

    /**
     * Méthode pour gérer une requête POST.
     *
     * @param array $params
     * Les paramètres nécessaires pour ajouter une origine.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        $this->oc->addOrigin($params);
    }
}
