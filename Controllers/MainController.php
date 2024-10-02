<?php

namespace Controllers;

use Exception;
use League\Plates\Engine;
use Models\UnitDAO;
use Views\constructor;

class MainController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine('./Views');
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {
        $unitDAO = new UnitDAO();
        $units = $unitDAO->getAll();
        $cardsHtml = constructor::createAllCards($units);
        $navBar = constructor::createNavbar();
        echo $this->templates->render('home', ['cardsHtml' => $cardsHtml, 'navBar' => $navBar]);
    }

    public function addUnit()
    {
        echo $this->templates->render('home', ['cardsHtml' => '', 'navBar' => constructor::createForm()]);
    }

}
