<?php

namespace Controllers\Router\Routes;

use Controllers\OriginController;
use Controllers\Router\Route;

/**
 * Classe RouteDeleteOrigin
 *
 * Cette classe représente une route pour supprimer une origine.
 * Elle gère les requêtes GET et POST en utilisant le contrôleur des origines (OriginController).
 */
class RouteDeleteOrigin extends Route
{
    /**
     * @var OriginController $oc
     * Instance du contrôleur des origines pour gérer les opérations de suppression.
     */
    private OriginController $oc;

    /**
     * Constructeur de la classe RouteDeleteOrigin.
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
     * Les paramètres passés à la route, utilisés pour confirmer ou afficher la suppression.
     *
     * @return void
     */
    public function getRoute(array $params): void
    {
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true') {
            $this->oc->deleteOrigin($params);
        } else {
            $this->oc->displayDeleteOriginView($params);
        }
    }

    /**
     * Méthode pour gérer une requête POST.
     *
     * @param array $params
     * Les paramètres nécessaires pour effectuer la suppression de l'origine.
     *
     * @return void
     */
    public function postRoute(array $params): void
    {
        $this->oc->deleteOrigin($params);
    }
}
