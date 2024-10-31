<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Managers\OriginManager;
use ReflectionClass;
use Views\constructor;

/**
 * Classe OriginController
 *
 * Cette classe gère les opérations relatives aux origines, comme l'ajout, l'édition, la suppression et la recherche.
 */
class OriginController
{
    /**
     * @var Engine $templates
     * Instance de l'engine de templates pour le rendu des vues.
     */
    private Engine $templates;

    /**
     * @var OriginManager $originManager
     * Manager des origines pour interagir avec les données des origines.
     */
    private OriginManager $originManager;

    /**
     * @var MainController $mainController
     * Instance du contrôleur principal pour gérer les notifications et l'affichage principal.
     */
    private MainController $mainController;

    /**
     * Constructeur de la classe OriginController.
     *
     * Initialise l'engine de templates, le manager des origines, et le contrôleur principal.
     */
    public function __construct()
    {
        $this->templates = new Engine('./Views');
        $this->originManager = new OriginManager();
        $this->mainController = new MainController();
    }

    /**
     * Affiche la fenêtre d'ajout d'une origine.
     *
     * @return void
     */
    public function displayAddUnitOriginWindow(): void
    {
        echo $this->templates->render('addOriginView');
    }

    /**
     * Affiche la fenêtre d'édition d'une origine.
     *
     * @param int|null $originId
     * L'ID de l'origine à éditer, si disponible.
     *
     * @return void
     */
    public function displayEditUnitWindow(int $originId = null): void
    {
        $all = $this->originManager->getAll();
        if (is_bool($all)) {
            $this->mainController->indexWithNotification('Erreur lors de l\'affichage de la page');
            return;
        }

        $selectedOrigin = null;
        if ($originId) {
            $selectedOrigin = $this->originManager->get($originId);
        }

        echo $this->templates->render('editOriginView', [
            'origins' => $all,
            'selectedOrigin' => $selectedOrigin
        ]);
    }

    /**
     * Affiche la fenêtre de suppression d'une origine.
     *
     * @param array $params
     * Les paramètres pour la suppression.
     *
     * @return void
     */
    public function displayDeleteOriginView(array $params): void
    {
        $origins = $this->originManager->getAll();
        if (is_bool($origins)) {
            $this->mainController->indexWithNotification('Erreur lors de l\'affichage de la page');
            return;
        }

        $selectedOrigin = null;
        if (isset($params['originId'])) {
            $selectedOrigin = $this->originManager->get($params['originId']);
        }

        echo $this->templates->render('deleteOriginView', [
            'origins' => $origins,
            'selectedOrigin' => $selectedOrigin,
        ]);
    }

    /**
     * Affiche les résultats de la recherche des origines.
     *
     * @param array $origins
     * Les résultats de la recherche.
     *
     * @return void
     */
    public function displaySearchOriginResults(array $origins): void
    {
        echo $this->templates->render('searchOriginView', [
            'tabOrigins' => constructor::createAllSearchedOriginCards($origins),
            'searched' => true
        ]);
    }

    /**
     * Affiche la vue de recherche des origines.
     *
     * @return void
     */
    public function displaySearchOriginView(): void
    {
        $reflectionClass = new ReflectionClass('Models\\Origin');
        $originProperties = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $originProperties[] = $property->getName();
        }

        echo $this->templates->render('searchOriginView', ['originProperties' => $originProperties]);
    }

    /**
     * Ajoute une origine.
     *
     * @param array $params
     * Les paramètres nécessaires pour ajouter l'origine.
     *
     * @return void
     */
    public function addOrigin(array $params): void
    {
        if ($this->originManager->create($params)) {
            $this->mainController->indexWithNotification('Ajout de l\'origine effectué !');
            return;
        }

        $this->mainController->indexWithNotification('Erreur lors de l\'ajout de l\'origine !');
    }

    /**
     * Met à jour une origine.
     *
     * @param array $params
     * Les paramètres nécessaires pour mettre à jour l'origine.
     *
     * @return void
     */
    public function updateOrigin(array $params): void
    {
        if ($this->originManager->update($params)) {
            $this->mainController->indexWithNotification('Modification enregistrée !');
            return;
        }

        $this->mainController->indexWithNotification('Erreur lors de la modification !');
    }

    /**
     * Supprime une origine.
     *
     * @param array $params
     * Les paramètres nécessaires pour la suppression, incluant l'ID de l'origine.
     *
     * @return void
     */
    public function deleteOrigin(array $params): void
    {
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true' && isset($params['originId'])) {
            if ($this->originManager->delete($params['originId'])) {
                $this->mainController->indexWithNotification('Suppression effectuée !');
                return;
            }
            $this->mainController->indexWithNotification('Erreur lors de la suppression !');
        }
    }

    /**
     * Effectue une recherche d'origines.
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
        return $this->originManager->searchByField($searchField, $searchTerm);
    }
}
