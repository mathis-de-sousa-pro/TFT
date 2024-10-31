<?php

namespace Models\DAO;

use Exception;
use Models\Origin;
use PDO;

class OriginDAO extends PDODAO
{
    /**
     * Récupère toutes les origines.
     *
     * @return array|null Retourne un tableau d'origines ou null si aucune origine n'est trouvée.
     * @throws Exception Si une erreur se produit lors de l'exécution de la requête.
     */
    public function getAll(): ?array
    {
        $sql = "SELECT * FROM origin";
        $stmt = $this->execRequest($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $origins = null;

        if ($result !== []) {
            $origins = [];
            foreach ($result as $row) {
                $origin = new Origin();
                $origin->hydrate($row);
                $origins[] = $origin;
            }
        }
        return $origins;
    }

    /**
     * Récupère une origine par son identifiant.
     *
     * @param int $originId L'identifiant de l'origine.
     * @return Origin|false Retourne un objet `Origin` ou `false` si aucune origine n'est trouvée.
     */
    public function read(int $originId): Origin|false
    {
        $sql = "SELECT * FROM origin WHERE id = :id";
        $stmt = $this->execRequest($sql, ['id' => $originId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data === false) {
            return false; // Aucun résultat trouvé, retourne `null`
        }

        $origin = new Origin();
        $origin->hydrate($data);
        return $origin;
    }

    /**
     * Supprime une origine par son identifiant.
     *
     * @param int $originId L'identifiant de l'origine.
     * @return bool Retourne `true` si l'origine a été supprimée, `false` si elle n'existe pas.
     */
    public function delete(int $originId): bool
    {
        $origin = $this->read($originId);
        if (!$origin) {
            return false; // L'origine n'existe pas
        }

        $sql = "DELETE FROM origin WHERE id = :id";
        $this->execRequest($sql, ['id' => $originId]);
        return true;
    }

    /**
     * Met à jour une origine.
     *
     * @param Origin $origin L'objet `Origin` à mettre à jour.
     * @return bool Retourne `true` si la mise à jour a réussi, `false` sinon.
     */
    public function update(Origin $origin): bool
    {
        $sql = 'UPDATE origin SET name = ?, url_img = ? WHERE id = ?';
        $this->execRequest($sql, [
            $origin->getName(),
            $origin->getUrlImg(),
            $origin->getId()
        ]);

        $updatedOrigin = $this->read($origin->getId());

        return ((!$updatedOrigin) ||(
            $updatedOrigin->getName() === $origin->getName() &&
            $updatedOrigin->getUrlImg() === $origin->getUrlImg()));
    }

    /**
     * Crée une nouvelle origine.
     *
     * @param Origin $origin L'objet `Origin` à insérer.
     * @return bool Retourne `true` si l'insertion a réussi, `false` sinon.
     */
    public function create(Origin $origin): bool
    {
        $sql = 'INSERT INTO origin (name, url_img) VALUES (?, ?)';
        $this->execRequest($sql, [
            $origin->getName(),
            $origin->getUrlImg()
        ]);

        return true;
    }

    public function getOriginsForUnit(string $unitId): array
    {
        // Requête SQL pour récupérer les origines associées à l'unité
        $sql = 'SELECT origin.id, origin.name, origin.url_img FROM origin
            INNER JOIN unitorigin ON origin.id = unitorigin.id_origin
            WHERE unitorigin.id_unit = ?';

        // Exécution de la requête
        $stmt = $this->execRequest($sql, [$unitId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Création des objets Origin à partir des résultats
        $origins = [];
        foreach ($result as $row) {
            $origin = new Origin();
            $origin->hydrate([
                'id' => $row['id'],
                'name' => $row['name'],
                'url_img' => $row['url_img']
            ]);
            $origins[] = $origin;
        }

        return $origins;
    }

    public function search(string $searchField, string $searchTerm): array
    {
        // Requête pour rechercher dans le champ spécifié
        $sql = "SELECT * FROM origin WHERE $searchField LIKE :term";
        $stmt = $this->execRequest($sql, ['term' => '%' . $searchTerm . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $origins = [];
        foreach ($results as $data) {
            $origin = new Origin();
            $origin->hydrate($data);
            $origins[]  = $origin;
        }

        return $origins;
    }


}
