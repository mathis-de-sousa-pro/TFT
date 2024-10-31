<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

/**
 * Classe RouteSearchUnit
 *
 * Cette classe représente une route pour effectuer une recherche sur les unités.
 * Elle gère les requêtes GET et POST en utilisant le contrôleur des unités (UnitController).
 */
class RouteSearchUnit extends Route
{
    /**
     * @var UnitController $uc
     * Instance du contrôleur des unités pour gérer les opérations de recherche.
     */
    private UnitController $uc;

    /**
     * Constructeur de la classe RouteSearchUnit.
     *
     * @param UnitController $oc
     * Le contrôleur des unités utilisé pour gérer les requêtes de la route.
     */
    public function __construct(UnitController $oc)
    {
        $this->uc = $oc;
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
        $this->uc->displaySearchUnitView();
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
            $results = $this->uc->search($searchField, $searchTerm);
            $this->uc->displaySearchUnitResults($results);
        } else {
            echo "Paramètres de recherche manquants.";
        }
    }
}
