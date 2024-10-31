<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

/**
 * Classe RouteDeleteUnit
 *
 * Cette classe représente une route pour supprimer une unité.
 * Elle gère les requêtes GET et POST en utilisant le contrôleur des unités (UnitController).
 */
class RouteDeleteUnit extends Route
{
    /**
     * @var UnitController $uc
     * Instance du contrôleur des unités pour gérer les opérations de suppression.
     */
    private UnitController $uc;

    /**
     * Constructeur de la classe RouteDeleteUnit.
     *
     * @param UnitController $oc
     * Le contrôleur des unités utilisé pour gérer les requêtes de la route.
     */
    public function __construct(UnitController $oc)
    {
        $this->uc = $oc;
    }

    /**
     * Méthode pour gérer une requête GET.
     *
     * @param array $params
     * Les paramètres passés à la route, utilisés pour confirmer ou afficher la suppression.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true') {
            $this->uc->deleteUnit($params);
        } else {
            $this->uc->displayDeleteUnitView($params);
        }
    }

    /**
     * Méthode pour gérer une requête POST.
     *
     * @param array $params
     * Les paramètres nécessaires pour effectuer la suppression de l'unité.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        $this->uc->deleteUnit($params);
    }
}
