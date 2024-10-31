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

    public function getAll(): array|false
    {
        $all = $this->unitDAO->getAll();
        if ($all == null)
            return false;
        return $all;
    }

    public function get(string $id): Unit|false
    {
        $unit = $this->unitDAO->read($id);
        if (!$unit)
            return false;
        return $unit;
    }

    public function update(array $params): bool
    {
        $unit = new Unit();
        $unit->hydrate($params);
        return $this->unitDAO->update($unit);
    }

    public function delete(string $id): bool
    {
        return $this->unitDAO->delete($id);
    }

    public function create(array $params): bool
    {
        //gestion du cas ou l'url de l'image du unit n'est pas renseigné
        if ((!isset($params["url_img"])) || ($params["url_img"] == '')) {
            $params["url_img"] = 'https://media.istockphoto.com/id/1055079680/vector/black-linear-photo-camera-like-no-image-available.jpg?s=612x612&w=0&k=20&c=P1DebpeMIAtXj_ZbVsKVvg-duuL0v9DlrOZUvPG6UJk=';
        }

        $unit = new Unit();
        $unit->hydrate($params);

        return $this->unitDAO->create($unit);
    }

    public function searchByField(string $field, string $term): array
    {
        return $this->unitDAO->search($field, $term);
    }
}