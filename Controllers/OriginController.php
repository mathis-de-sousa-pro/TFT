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
        echo $this->templates->render('addUnitOriginView');
    }

    public function addOrigin(array $params)
    {
        if( $this->originManager->create($params))
        {
            $this->mainController->indexWithNotification('ajout de l\'origine effectué !');
            return;
        }

        $this->mainController->indexWithNotification('erreur lors de l\'ajout de l\'origne');

    }
}