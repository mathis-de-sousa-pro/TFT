<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Managers\OriginManager;
use Models\Managers\UnitManager;

class OriginController
{
    private Engine $templates;
    private OriginManager $originManager;
    private MainController $mainController;

    public function __construct()
    {
        $this->templates = new Engine('./Views');
        $this->originManager = new OriginManager();
        $this->mainController = new MainController();
    }

    public function displayAddUnitOriginWindow(array $params): void
    {
        echo $this->templates->render('addOriginView');
    }

    public function displayEditUnitWindow(int $originId = null): void
    {
        $all = $this->originManager->getAll();
        if (is_bool($all))
        {
            $this -> mainController -> indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }

        $selectedOrigin = null;

        if ($originId)
            $selectedOrigin = $this->originManager->get($originId);

        echo $this->templates->render('editOriginView', [
            'origins' => $all,
            'selectedOrigin' => $selectedOrigin
        ]);
    }

    public function displayDeleteOriginView(array $params): void
    {
        $origins = $this->originManager->getAll();
        $selectedOrigin = null;

        if (is_bool($origins)){
            $this->mainController->indexWithNotification('erreur lors de l\'affichage de la page');
            return;
        }


        if (isset($params['originId']))
            $selectedUnit = $this->originManager->get($params['originId']);

        echo $this -> templates -> render('deleteOriginView', [
            'origins' => $origins,
            'selectedOrigin' => $selectedOrigin,
        ]);
    }

    public function addOrigin(array $params): void
    {
        if( $this->originManager->create($params))
        {
            $this->mainController->indexWithNotification('ajout de l\'origine effectué !');
            return;
        }

        $this->mainController->indexWithNotification('erreur lors de l\'ajout de l\'origne');

    }

    public function updateOrigin(array $params): void
    {
        if (empty($data['Id']))
        {
            echo "Error: Origin ID is missing.";
            return;
        }

        // Mise à jour de l'unité via le manager
        if ($this -> originManager -> update($data))
        {
            $this -> mainController -> indexWithNotification('modification enregistrée');
            return;
        }
        $this -> mainController -> indexWithNotification('erreur lors de la modification');
    }

    public function deleteOrigin(array $params) : void
    {
        if (isset($params['confirmDelete']) && $params['confirmDelete'] === 'true' && isset($params['originId']))
        {
            if ($this -> originManager -> delete($params['originId']))
            {
                $this -> mainController -> indexWithNotification('suppression effectuée !');
                return;
            }
            $this -> mainController -> indexWithNotification('erreur lors de la suppression');
        }
    }
}