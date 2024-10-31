<?php

namespace Controllers\Router\Routes;

use Controllers\UnitController;
use Controllers\Router\Route;

/**
 * Classe RouteEditUnit
 *
 * Cette classe représente une route pour modifier une unité.
 * Elle gère les requêtes GET et POST en utilisant le contrôleur des unités (UnitController).
 */
class RouteEditUnit extends Route
{
    /**
     * @var UnitController $uc
     * Instance du contrôleur des unités pour gérer les opérations de modification.
     */
    private UnitController $uc;

    /**
     * Constructeur de la classe RouteEditUnit.
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
     * Les paramètres passés à la route, y compris l'ID de l'unité pour afficher le formulaire de modification.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        if (isset($params['unitId'])) {
            $this->uc->displayEditUnitWindow($params['unitId']);
        } else {
            $this->uc->displayEditUnitWindow();
        }
    }

    /**
     * Méthode pour gérer une requête POST.
     *
     * @param array $params
     * Les paramètres nécessaires pour mettre à jour l'unité.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        $this->uc->updateUnit($params);
    }
}
