<?php

namespace Controllers;

use League\Plates\Engine;
use Models\DAO\UnitDAO;

class UnitController
{
    private Engine $templates;
    private UnitDAO $unitDAO;

    public function __construct()
    {
        $this->templates = new Engine('./Views');
        $this->unitDAO = new UnitDAO();
    }

    public function displayUnitSelectionView(): void
    {
        $units = $this->unitDAO->getAll(); // Récupère toutes les unités pour le menu déroulant
        echo $this->templates->render('editUnitView', ['units' => $units, 'selectedUnit' => null]);
    }

    public function displayEditUnitView(string $unitId): void
    {
        $unit = $this->unitDAO->findById($unitId); // Récupère les détails de l'unité sélectionnée
        $units = $this->unitDAO->getAll();
        echo $this->templates->render('editUnitView', ['units' => $units, 'selectedUnit' => $unit]);
    }

    public function updateUnit(array $params): void
    {
        // Met à jour l'unité avec les nouvelles données
        $unit = $this->unitDAO->read((int)$params['unitId']);
        $unit->setName($params['unitName']);
        $unit->setCost((int)$params['unitCost']);
        $unit->setOrigin($params['unitOrigin']);
        $unit->setUrlImg($params['unitImageUrl']);

        $this->unitDAO->update($unit); // Enregistre les modifications
        header("Location: /TFT/index.php?action=edit-unit&unitId={$params['unitId']}");
        exit;
    }

    public function displaySearchView(): void
    {
        // Utilise la réflexion pour obtenir les noms des propriétés de la classe Unit
        $reflectionClass = new \ReflectionClass('Models\\Unit');
        $unitProperties = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $unitProperties[] = $property->getName();
        }        // Transmet les propriétés à la vue

        echo $this->templates->render('searchView', ['unitProperties' => $unitProperties]);
    }

    public function displayAddUnitWindow(array $params): void
    {
        echo $this->templates->render('addUnitView');
    }

    public function displayAddUnitOriginWindow(array $params): void
    {
        echo $this->templates->render('addUnitOriginView');
    }

    public function displayDeleteView(array $params): void
    {
        echo $this->templates->render('deleteView');
    }
}
