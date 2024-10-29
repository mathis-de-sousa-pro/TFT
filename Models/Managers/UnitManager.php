<?php

namespace Models\Managers;

use Exception;
use Models\DAO\UnitDAO;

class UnitManager
{

    private UnitDAO $unitDAO;

    public function __construct()
    {
        $this->unitDAO = new UnitDAO();
    }

    public function getAll(): array
    {
        try
        {
            return $this -> unitDAO -> getAll();
        }
        catch ( Exception $e )
        {
            echo "Erreur lors de la récupération des units \n" . $e -> getMessage();
            return array();
        }
    }
}