<?php

namespace Models\Managers;

use Exception;
use Models\DAO\UnitDAO;
use Models\Unit;

/**
 * Classe UnitManager
 *
 * Gère les opérations de gestion des unités, comme la récupération, l'ajout, la mise à jour, et la suppression.
 */
class UnitManager
{
    /**
     * @var UnitDAO $unitDAO
     * Instance de l'objet Data Access Object (DAO) pour interagir avec les données des unités.
     */
    private UnitDAO $unitDAO;

    /**
     * Constructeur de la classe UnitManager.
     *
     * Initialise l'instance de UnitDAO pour la gestion des données des unités.
     */
    public function __construct()
    {
        $this->unitDAO = new UnitDAO();
    }

    /**
     * Récupère toutes les unités.
     *
     * @return array|false
     * Retourne un tableau de toutes les unités ou false si aucune unité n'est trouvée.
     *
     * @throws Exception
     */
    public function getAll(): array|false
    {
        $all = $this->unitDAO->getAll();
        if ($all == null) {
            return false;
        }
        return $all;
    }

    /**
     * Récupère une unité par son ID.
     *
     * @param string $id
     * L'ID de l'unité à récupérer.
     *
     * @return Unit|false
     * Retourne l'unité trouvée ou false si l'unité n'existe pas.
     */
    public function get(string $id): Unit|false
    {
        $unit = $this->unitDAO->read($id);
        if (!$unit) {
            return false;
        }
        return $unit;
    }

    /**
     * Met à jour une unité avec les données fournies.
     *
     * @param array $params
     * Les données de l'unité à mettre à jour.
     *
     * @return bool
     * Retourne true si la mise à jour a réussi, sinon false.
     */
    public function update(array $params): bool
    {
        $unit = new Unit();
        $unit->hydrate($params);
        return $this->unitDAO->update($unit);
    }

    /**
     * Supprime une unité par son ID.
     *
     * @param string $id
     * L'ID de l'unité à supprimer.
     *
     * @return bool
     * Retourne true si la suppression a réussi, sinon false.
     */
    public function delete(string $id): bool
    {
        return $this->unitDAO->delete($id);
    }

    /**
     * Crée une nouvelle unité avec les données fournies.
     *
     * @param array $params
     * Les données de l'unité à créer.
     *
     * @return bool
     * Retourne true si la création a réussi, sinon false.
     */
    public function create(array $params): bool
    {
        // Gestion du cas où l'URL de l'image de l'unité n'est pas renseignée
        if ((!isset($params["url_img"])) || ($params["url_img"] == '')) {
            $params["url_img"] = 'https://media.istockphoto.com/id/1055079680/vector/black-linear-photo-camera-like-no-image-available.jpg?s=612x612&w=0&k=20&c=P1DebpeMIAtXj_ZbVsKVvg-duuL0v9DlrOZUvPG6UJk=';
        }

        $unit = new Unit();
        $unit->hydrate($params);

        return $this->unitDAO->create($unit);
    }

    /**
     * Recherche des unités en fonction d'un champ et d'un terme.
     *
     * @param string $field
     * Le champ sur lequel effectuer la recherche.
     * @param string $term
     * Le terme de recherche.
     *
     * @return array
     * Retourne un tableau des résultats de la recherche.
     */
    public function searchByField(string $field, string $term): array
    {
        return $this->unitDAO->search($field, $term);
    }
}
