<?php

namespace Models\Managers;

use Exception;
use Models\DAO\OriginDAO;
use Models\Origin;

/**
 * Classe OriginManager
 *
 * Gère les opérations de gestion des origines, comme la création, la récupération, la mise à jour et la suppression.
 */
class OriginManager
{
    /**
     * @var OriginDAO $originDAO
     * Instance de l'objet Data Access Object (DAO) pour interagir avec les données des origines.
     */
    private OriginDAO $originDAO;

    /**
     * Constructeur de la classe OriginManager.
     *
     * Initialise l'instance de OriginDAO pour la gestion des données des origines.
     */
    public function __construct()
    {
        $this->originDAO = new OriginDAO();
    }

    /**
     * Crée une nouvelle origine avec les données fournies.
     *
     * @param array $params
     * Les données de l'origine à créer.
     *
     * @return bool
     * Retourne true si la création a réussi, sinon false.
     */
    public function create(array $params): bool
    {
        // Gestion du cas où l'URL de l'image de l'origine n'est pas renseignée
        if ((!isset($params["url_img"])) || ($params["url_img"] == '')) {
            $params["url_img"] = 'https://media.istockphoto.com/id/1055079680/vector/black-linear-photo-camera-like-no-image-available.jpg?s=612x612&w=0&k=20&c=P1DebpeMIAtXj_ZbVsKVvg-duuL0v9DlrOZUvPG6UJk=';
        }

        $origin = new Origin();
        $origin->hydrate($params);
        return $this->originDAO->create($origin);
    }

    /**
     * Récupère toutes les origines.
     *
     * @return array|false
     * Retourne un tableau de toutes les origines ou false si aucune origine n'est trouvée.
     *
     * @throws Exception
     */
    public function getAll(): array|false
    {
        $all = $this->originDAO->getAll();
        if ($all == null) {
            return false;
        }
        return $all;
    }

    /**
     * Récupère les origines associées à une unité.
     *
     * @param string $unitId
     * L'ID de l'unité pour laquelle récupérer les origines.
     *
     * @return array|false
     * Retourne un tableau d'origines ou false si aucune origine n'est trouvée.
     */
    public function getOriginsForUnit(string $unitId): array|false
    {
        $origins = $this->originDAO->getOriginsForUnit($unitId);
        if ($origins == null) {
            return false;
        }
        return $origins;
    }

    /**
     * Récupère une origine par son ID.
     *
     * @param int $id
     * L'ID de l'origine à récupérer.
     *
     * @return Origin|false
     * Retourne l'origine trouvée ou false si l'origine n'existe pas.
     */
    public function get(int $id): Origin|false
    {
        $origin = $this->originDAO->read($id);
        if (!$origin) {
            return false;
        }
        return $origin;
    }

    /**
     * Met à jour une origine avec les données fournies.
     *
     * @param array $data
     * Les données de l'origine à mettre à jour.
     *
     * @return bool
     * Retourne true si la mise à jour a réussi, sinon false.
     */
    public function update(array $data): bool
    {
        $origin = new Origin();
        $origin->hydrate($data);
        return $this->originDAO->update($origin);
    }

    /**
     * Supprime une origine par son ID.
     *
     * @param mixed $originId
     * L'ID de l'origine à supprimer.
     *
     * @return bool
     * Retourne true si la suppression a réussi, sinon false.
     */
    public function delete(mixed $originId): bool
    {
        return $this->originDAO->delete($originId);
    }

    /**
     * Recherche des origines en fonction d'un champ et d'un terme.
     *
     * @param string $searchField
     * Le champ sur lequel effectuer la recherche.
     * @param string $searchTerm
     * Le terme de recherche.
     *
     * @return array
     * Retourne un tableau des résultats de la recherche.
     */
    public function searchByField(string $searchField, string $searchTerm): array
    {
        return $this->originDAO->search($searchField, $searchTerm);
    }
}
