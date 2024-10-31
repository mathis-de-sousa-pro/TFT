<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Managers\OriginManager;
use Models\Managers\UnitManager;
use Views\constructor;

class UnitController
{
    private Engine $templates;
    private UnitManager $unitManager;
    private OriginManager $originManager;
    private MainController $mainController; // Utilisation du MainController pour rediriger vers l'index

    public function __construct()
    {
        $this -> templates = new Engine('./Views');
        $this -> unitManager = new UnitManager();
        $this -> mainController = new MainController();
        $this -> originManager = new OriginManager();
    }

    public function displayEditUnitWindow(string $unitId = null): void
    {
        $all = $this -> unitManager -> getAll();
        if (is_bool($all))
        {
            $this -> mainController -> indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }

        $selectedUnit = null;
        $selectedUnitOrigins = [];
        $origins = [];

        // Si un ID est fourni, récupère les données de l'unité sélectionnée
        if ($unitId)
        {
            $selectedUnit = $this -> unitManager -> get($unitId);
            $selectedUnitOrigins = $this->originManager->getOriginsForUnit($unitId);
            $origins = $this->originManager->getAll();
        }



        echo $this -> templates -> render('editUnitView', [
            'units' => $all,
            'selectedUnit' => $selectedUnit,
            'listOrigins' => constructor::createOriginSelection($origins, $selectedUnitOrigins)
        ]);
    }

    public function displaySearchUnitView(): void
    {
        // Utilise la réflexion pour obtenir les noms des propriétés de la classe Unit
        $reflectionClass = new \ReflectionClass('Models\\Unit');
        $unitProperties = [];

        foreach ($reflectionClass -> getProperties() as $property)
        {
            $unitProperties[] = $property -> getName();
        }

        // Transmet les propriétés à la vue
        echo $this -> templates -> render('searchUnitView', ['unitProperties' => $unitProperties]);
    }

    public function displayAddUnitWindow(): void
    {
        $listOrigins = $this -> originManager -> getAll();
        echo $this -> templates -> render('addUnitView', ['listOrigins' => constructor ::createOriginSelection($listOrigins)]);
    }

    public function displayDeleteUnitView(array $params): void
    {
        $all = $this -> unitManager -> getAll();
        if (is_bool($all))
        {
            $this -> mainController -> indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }

        $units = $all;
        $selectedUnit = null;

        // Vérifie si un ID d'unité est passé en paramètre pour sélectionner une unité
        if (isset($params['unitId']))
        {
            $selectedUnit = $this -> unitManager -> get($params['unitId']);
        }

        // Affiche la vue de suppression avec toutes les unités et l'unité sélectionnée
        echo $this -> templates -> render('deleteUnitView', [
            'units' => $units,
            'selectedUnit' => $selectedUnit,
        ]);
    }

    public function displaySearchUnitResults(array $units): void
    {
        echo $this->templates->render('searchUnitView', [
            'tabUnits' => constructor::createAllSearchedCards($units),
            'searched' => true
        ]);
    }

    public function deleteUnit(array $params): void
    {
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true' && isset($params['unitId']))
        {
            if ($this -> unitManager -> delete($params['unitId']))
            {
                $this -> mainController -> indexWithNotification('suppression effectuée !');
                return;
            }
            $this -> mainController -> indexWithNotification('erreur lors de la suppression');
        }
    }

    public function addUnit(array $params): void
    {
        if ($this -> unitManager -> create($params))
        {
            $this -> mainController -> indexWithNotification('ajout effectué !');
            return;
        }

        $this -> mainController -> indexWithNotification('erreur lors de l\'ajout');
    }

    public function updateUnit(array $data): void
    {
        // Vérifie que `unitId` est bien défini dans les données POST
        if (empty($data['Id']))
        {
            echo "Error: Unit ID is missing.";
            return;
        }

        // Mise à jour de l'unité via le manager
        if ($this -> unitManager -> update($data))
        {
            $this -> mainController -> indexWithNotification('modification enregistrée');
            return;
        }
        $this -> mainController -> indexWithNotification('erreur lors de la modification');
    }

    public function search(string $searchField, string $searchTerm): array
    {
        // Appel du manager pour rechercher des unités en fonction du champ et du terme
        return $this->unitManager->searchByField($searchField, $searchTerm);
    }
}
