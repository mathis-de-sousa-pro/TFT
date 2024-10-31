<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Managers\OriginManager;
use Models\Managers\UnitManager;
use ReflectionClass;
use Views\constructor;

/**
 * Classe UnitController
 *
 * Cette classe gère les opérations relatives aux unités, comme l'ajout, l'édition, la suppression, et la recherche.
 */
class UnitController
{
    /**
     * @var Engine $templates
     * Instance de l'engine de templates pour le rendu des vues.
     */
    private Engine $templates;

    /**
     * @var UnitManager $unitManager
     * Manager des unités pour interagir avec les données des unités.
     */
    private UnitManager $unitManager;

    /**
     * @var OriginManager $originManager
     * Manager des origines pour obtenir les origines associées aux unités.
     */
    private OriginManager $originManager;

    /**
     * @var MainController $mainController
     * Instance du contrôleur principal pour rediriger et afficher les notifications.
     */
    private MainController $mainController;

    /**
     * Constructeur de la classe UnitController.
     *
     * Initialise l'engine de templates, le manager des unités, et le contrôleur principal.
     */
    public function __construct()
    {
        $this->templates = new Engine('./Views');
        $this->unitManager = new UnitManager();
        $this->mainController = new MainController();
        $this->originManager = new OriginManager();
    }

    /**
     * Affiche la fenêtre d'édition d'une unité.
     *
     * @param string|null $unitId
     * L'ID de l'unité à éditer, si disponible.
     *
     * @return void
     */
    public function displayEditUnitWindow(string $unitId = null): void
    {
        $all = $this->unitManager->getAll();
        if (is_bool($all)) {
            $this->mainController->indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }

        $selectedUnit = null;
        $selectedUnitOrigins = [];
        $origins = [];

        if ($unitId) {
            $selectedUnit = $this->unitManager->get($unitId);
            $selectedUnitOrigins = $this->originManager->getOriginsForUnit($unitId);
            $origins = $this->originManager->getAll();
        }

        echo $this->templates->render('editUnitView', [
            'units' => $all,
            'selectedUnit' => $selectedUnit,
            'listOrigins' => constructor::createOriginSelection($origins, $selectedUnitOrigins)
        ]);
    }

    /**
     * Affiche la vue de recherche des unités.
     *
     * @return void
     */
    public function displaySearchUnitView(): void
    {
        $reflectionClass = new ReflectionClass('Models\\Unit');
        $unitProperties = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $unitProperties[] = $property->getName();
        }

        echo $this->templates->render('searchUnitView', ['unitProperties' => $unitProperties]);
    }

    /**
     * Affiche la fenêtre d'ajout d'une unité.
     *
     * @return void
     */
    public function displayAddUnitWindow(): void
    {
        $listOrigins = $this->originManager->getAll();
        echo $this->templates->render('addUnitView', ['listOrigins' => constructor::createOriginSelection($listOrigins)]);
    }

    /**
     * Affiche la fenêtre de suppression d'une unité.
     *
     * @param array $params
     * Les paramètres pour la suppression.
     *
     * @return void
     */
    public function displayDeleteUnitView(array $params): void
    {
        $all = $this->unitManager->getAll();
        if (is_bool($all)) {
            $this->mainController->indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }

        $units = $all;
        $selectedUnit = null;

        if (isset($params['unitId'])) {
            $selectedUnit = $this->unitManager->get($params['unitId']);
        }

        echo $this->templates->render('deleteUnitView', [
            'units' => $units,
            'selectedUnit' => $selectedUnit,
        ]);
    }

    /**
     * Affiche les résultats de la recherche des unités.
     *
     * @param array $units
     * Les résultats de la recherche.
     *
     * @return void
     */
    public function displaySearchUnitResults(array $units): void
    {
        echo $this->templates->render('searchUnitView', [
            'tabUnits' => constructor::createAllSearchedUnitCards($units),
            'searched' => true
        ]);
    }

    /**
     * Supprime une unité.
     *
     * @param array $params
     * Les paramètres nécessaires pour la suppression, incluant l'ID de l'unité.
     *
     * @return void
     */
    public function deleteUnit(array $params): void
    {
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true' && isset($params['unitId'])) {
            if ($this->unitManager->delete($params['unitId'])) {
                $this->mainController->indexWithNotification('Suppression effectuée !');
                return;
            }
            $this->mainController->indexWithNotification('Erreur lors de la suppression !');
        }
    }

    /**
     * Ajoute une unité.
     *
     * @param array $params
     * Les paramètres nécessaires pour ajouter l'unité.
     *
     * @return void
     */
    public function addUnit(array $params): void
    {
        if ($this->unitManager->create($params)) {
            $this->mainController->indexWithNotification('Ajout effectué !');
            return;
        }

        $this->mainController->indexWithNotification('Erreur lors de l\'ajout !');
    }

    /**
     * Met à jour une unité.
     *
     * @param array $data
     * Les données nécessaires pour mettre à jour l'unité.
     *
     * @return void
     */
    public function updateUnit(array $data): void
    {
        if (empty($data['Id'])) {
            echo "Erreur : ID de l'unité manquant.";
            return;
        }

        if ($this->unitManager->update($data)) {
            $this->mainController->indexWithNotification('Modification enregistrée !');
            return;
        }
        $this->mainController->indexWithNotification('Erreur lors de la modification du unit !');
    }

    /**
     * Recherche des unités en fonction d'un champ et d'un terme.
     *
     * @param string $searchField
     * Le champ sur lequel effectuer la recherche.
     * @param string $searchTerm
     * Le terme de recherche.
     *
     * @return array
     * Les résultats de la recherche.
     */
    public function search(string $searchField, string $searchTerm): array
    {
        return $this->unitManager->searchByField($searchField, $searchTerm);
    }
}
