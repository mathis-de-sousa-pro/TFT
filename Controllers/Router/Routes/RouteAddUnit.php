<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

/**
 * Classe RouteAddUnit
 *
 * Cette classe représente une route spécifique pour ajouter une unité.
 * Elle hérite de la classe Route et gère les requêtes GET et POST
 * en utilisant le contrôleur d'unités (UnitController).
 */
class RouteAddUnit extends Route
{
    /**
     * @var UnitController $uc
     * Instance du contrôleur d'unités pour gérer les opérations liées aux unités.
     */
    private UnitController $uc;

    /**
     * Constructeur de la classe RouteAddUnit.
     *
     * @param UnitController $oc
     * Le contrôleur d'unités utilisé pour gérer les requêtes de la route.
     */
    public function __construct(UnitController $oc)
    {
        $this->uc = $oc;
    }

    /**
     * Méthode pour gérer une requête GET.
     *
     * @param array $params
     * Les paramètres passés à la route, non utilisés dans cette méthode.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        $this->uc->displayAddUnitWindow();
    }

    /**
     * Méthode pour gérer une requête POST.
     *
     * @param array $params
     * Les paramètres nécessaires pour ajouter une unité.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        $this->uc->addUnit($params);
    }
}
