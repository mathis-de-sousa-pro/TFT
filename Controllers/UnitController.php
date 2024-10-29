<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Managers\UnitManager;
use Models\Unit;

class UnitController
{
    private Engine $templates;
    private UnitManager $unitManager;
    private MainController $mainController; // Utilisation du MainController pour rediriger vers l'index

    public function __construct()
    {
        $this->templates = new Engine('./Views');
        $this->unitManager = new UnitManager();
        $this->mainController = new MainController(); // Initialisation de MainController
    }

    public function displayEditUnitWindow(string $unitId = null): void
    {
        // Récupère toutes les unités pour la liste de sélection
        $units = $this->unitManager->getAll();
        $selectedUnit = null;

        // Si un ID est fourni, récupère les données de l'unité sélectionnée
        if ($unitId) {
            $selectedUnit = $this->unitManager->get($unitId);
        }

        echo $this->templates->render('editUnitView', [
            'units' => $units,
            'selectedUnit' => $selectedUnit
        ]);
    }

    public function updateUnit(array $data): void
    {
        // Vérifie que `unitId` est bien défini dans les données POST
        if (empty($data['Id'])) {
            echo "Error: Unit ID is missing.";
            return;
        }

        // Création d'une nouvelle instance d'unité et hydratation des données
        $unit = new Unit();
        $unit->hydrate($data);
        // Mise à jour de l'unité via le manager
        if( $this->unitManager->updateUnit($data))
        {
            $this->mainController->indexWithNotification('modification enregistrée');
            return;
        }
        $this->mainController->indexWithNotification('erreur lors de la modification');
    }

    public function displaySearchView(): void
    {
        // Utilise la réflexion pour obtenir les noms des propriétés de la classe Unit
        $reflectionClass = new \ReflectionClass('Models\\Unit');
        $unitProperties = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $unitProperties[] = $property->getName();
        }

        // Transmet les propriétés à la vue
        echo $this->templates->render('searchView', ['unitProperties' => $unitProperties]);
    }

    public function displayAddUnitWindow(): void
    {
        echo $this->templates->render('addUnitView');
    }

    public function displayAddUnitOriginWindow(array $params): void
    {
        echo $this->templates->render('addUnitOriginView');
    }

    public function displayDeleteView(array $params): void
    {
        // Récupère toutes les unités pour le menu déroulant et l'unité sélectionnée
        $units = $this->unitManager->getAll();
        $selectedUnit = null;

        // Vérifie si un ID d'unité est passé en paramètre pour sélectionner une unité
        if (isset($params['unitId'])) {
            $selectedUnit = $this->unitManager->get($params['unitId']);
        }

        // Affiche la vue de suppression avec toutes les unités et l'unité sélectionnée
        echo $this->templates->render('deleteView', [
            'units' => $units,
            'selectedUnit' => $selectedUnit,
        ]);
    }

    public function deleteUnit(array $params): void
    {
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true' && isset($params['unitId'])) {
            // Supprime l'unité via le manager
            $this->unitManager->delete($params['unitId']);

            return;
        }

        // Si aucun paramètre de suppression valide, redirige vers la vue de suppression
        $this->displayDeleteView($params);
    }

}
