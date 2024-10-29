<?php

namespace Models\Managers;

use Exception;
use Models\DAO\UnitDAO;
use Models\Unit;

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

    public function get(int $id): Unit|false
    {
        try
        {
            return $this->unitDAO->read($id);
        }
        catch (Exception $e)
        {
            echo "Erreur lors de la récupération du unit" . PHP_EOL . $e->getMessage();
            return false;
        }
    }

    public function updateUnit(array $params): bool
    {
        $unit = new Unit();
        $unit->hydrate($params);
        return $this->unitDAO->update($unit);
    }

    public function delete(int $id)
    {
        $this->unitDAO->delete((string)$id);
    }
}