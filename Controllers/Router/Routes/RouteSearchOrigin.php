<?php

namespace Controllers\Router\Routes;

use Controllers\OriginController;
use Controllers\Router\Route;

class RouteSearchOrigin extends Route
{

    private OriginController $oc;

    public function __construct(OriginController $oc)
    {
        $this->oc = $oc;
    }

    public function getRoute(array $params): void
    {
        $this->oc->displaySearchOriginView();
    }

    public function postRoute(array $params): void
    {
        // Vérifie que les paramètres nécessaires sont présents
        if (isset($params['searchTerm'], $params['searchField'])) {
            $searchTerm = htmlspecialchars($params['searchTerm']);
            $searchField = htmlspecialchars($params['searchField']);

            // Appel du contrôleur pour récupérer les résultats de la recherche
            $results = $this->oc->search($searchField, $searchTerm);

            // Rendu de la vue avec les résultats de recherche
            $this->oc->displaySearchOriginResults($results);
        } else {
            echo "Paramètres de recherche manquants.";
        }
    }
}