<?php

namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteSearchUnit extends Route
{

    private UnitController $uc;

    public function __construct(UnitController $sc)
    {
        $this->uc = $sc;
    }

    /**
     * @inheritDoc
     */
    public function getRoute(array $params): void
    {
        $this->uc->displaySearchUnitView();
    }

    /**
     * @inheritDoc
     */
    public function postRoute(array $params): void
    {
        // Vérifie que les paramètres nécessaires sont présents
        if (isset($params['searchTerm'], $params['searchField'])) {
            $searchTerm = htmlspecialchars($params['searchTerm']);
            $searchField = htmlspecialchars($params['searchField']);

            // Appel du contrôleur pour récupérer les résultats de la recherche
            $results = $this->uc->search($searchField, $searchTerm);

            // Rendu de la vue avec les résultats de recherche
            $this->uc->displaySearchUnitResults($results);
        } else {
            echo "Paramètres de recherche manquants.";
        }
    }
}