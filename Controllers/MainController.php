<?php

namespace Controllers;

use Exception;
use League\Plates\Engine;
use Models\DAO\UnitDAO;
use Models\Managers\UnitManager;
use Models\Unit;
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
        echo $this->templates->render('home', ['cardsHtml' => $cardsHtml, 'message' => '']);
    }

    public function indexWithNotification(string $text): void
    {
        $units = $this->unitManager->getAll();
        $cardsHtml = constructor::createAllCards($units);
        echo $this->templates->render('home', [
            'cardsHtml' => $cardsHtml,
            'notificationHtml' => constructor::createMessageNotification($text) // Passe le toast à la vue
        ]);
    }


}
