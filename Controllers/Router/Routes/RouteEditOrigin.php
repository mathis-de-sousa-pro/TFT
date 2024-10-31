<?php

namespace Controllers\Router\Routes;

use Controllers\OriginController;
use Controllers\Router\Route;

/**
 * Classe RouteEditOrigin
 *
 * Cette classe représente une route pour modifier une origine.
 * Elle gère les requêtes GET et POST en utilisant le contrôleur des origines (OriginController).
 */
class RouteEditOrigin extends Route
{
    /**
     * @var OriginController $oc
     * Instance du contrôleur des origines pour gérer les opérations de modification.
     */
    private OriginController $oc;

    /**
     * Constructeur de la classe RouteEditOrigin.
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
     * Les paramètres passés à la route, y compris l'ID de l'origine pour afficher le formulaire de modification.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        if (isset($params['originId'])) {
            $this->oc->displayEditUnitWindow($params['originId']);
        } else {
            $this->oc->displayEditUnitWindow();
        }
    }

    /**
     * Méthode pour gérer une requête POST.
     *
     * @param array $params
     * Les paramètres nécessaires pour mettre à jour l'origine.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        $this->oc->updateOrigin($params);
    }
}
