<?php

namespace Controllers;

use League\Plates\Engine;

class MainController
{
    private Engine $templates;

    public function index() : void {
        echo $this->templates->render('home', ['tftSetName' => 'Remix Rumble']);
    }
}