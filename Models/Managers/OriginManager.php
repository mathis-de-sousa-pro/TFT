<?php

namespace Models\Managers;

use Controllers\OriginController;
use Models\DAO\OriginDAO;
use Models\Origin;

class OriginManager
{

    private OriginDAO $originDAO;

    public function __construct(){
        $this->originDAO = new OriginDAO();
    }

    public function create(array $params): bool
    {
        //gestion du cas ou l'url de l'image du unit n'est pas renseigné
        if ((!isset($params["url_img"])) || ($params["url_img"] == '')) {
            $params["url_img"] = 'https://media.istockphoto.com/id/1055079680/vector/black-linear-photo-camera-like-no-image-available.jpg?s=612x612&w=0&k=20&c=P1DebpeMIAtXj_ZbVsKVvg-duuL0v9DlrOZUvPG6UJk=';
        }

        $origin = new Origin();
        $origin->hydrate($params);
        return $this->originDAO->create($origin);
    }

    public function getAll(): array|false
    {
        $all = $this->originDAO->getAll();
        if ($all == null)
            return false;
        return $all;
    }

    public function getOriginsForUnit(string $unitId): array|false
    {
        $origins = $this->originDAO->getOriginsForUnit($unitId);
        if ($origins == null)
            return false;
        return $origins;
    }

    public function get(int $id): Origin|false
    {
        $origin = $this->originDAO->read($id);
        if (!$origin)
            return false;
        return $origin;
    }
}