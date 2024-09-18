<?php

namespace Controllers;

use Exception;
use League\Plates\Engine;
use Models\UnitDAO;

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

        echo $this->templates->render('home', ['getAll' => $unitDAO->getAll()[0]]);
    }
}
