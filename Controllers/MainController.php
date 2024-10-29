<?php

namespace Controllers;

use Exception;
use League\Plates\Engine;
use Models\DAO\UnitDAO;
use Models\Managers\UnitManager;
use Views\constructor;

class MainController
{
    private Engine $templates;
    private UnitManager $unitManager;

    public function __construct()
    {
        $this->templates = new Engine('./Views');
        $this->unitManager = new UnitManager();
    }

    public function index(): void
    {
        $units = $this->unitManager->getAll();
        $cardsHtml = constructor::createAllCards($units);
        echo $this->templates->render('home', ['cardsHtml' => $cardsHtml]);
    }

}
