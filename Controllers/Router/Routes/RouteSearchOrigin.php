<?php

namespace Controllers\Router\Routes;

use Controllers\OriginController;
use Controllers\Router\Route;

/**
 * Classe RouteSearchOrigin
 *
 * Cette classe représente une route pour effectuer une recherche sur les origines.
 * Elle gère les requêtes GET et POST en utilisant le contrôleur des origines (OriginController).
 */
class RouteSearchOrigin extends Route
{
    /**
     * @var OriginController $oc
     * Instance du contrôleur des origines pour gérer les opérations de recherche.
     */
    private OriginController $oc;

    /**
     * Constructeur de la classe RouteSearchOrigin.
     *
     * @param OriginController $oc
     * Le contrôleur des origines utilisé pour gérer les requêtes de la route.
     */
    public function __construct(OriginController $oc)
    {
        $this->oc = $oc;
    }

    /**
     * Gère les requêtes GET pour afficher la vue de recherche.
     *
     * @param array $params
     * Les paramètres pour la route.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        $this->oc->displaySearchOriginView();
    }

    /**
     * Gère les requêtes POST pour effectuer une recherche.
     *
     * @param array $params
     * Les paramètres nécessaires pour exécuter la recherche, comme le terme de recherche et le champ.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        if (isset($params['searchTerm'], $params['searchField'])) {
            $searchTerm = htmlspecialchars($params['searchTerm']);
            $searchField = htmlspecialchars($params['searchField']);
            $results = $this->oc->search($searchField, $searchTerm);
            $this->oc->displaySearchOriginResults($results);
        } else {
            echo "Paramètres de recherche manquants.";
        }
    }
}
