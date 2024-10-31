<?php

namespace Models\DAO;

use Exception;
use Models\Unit;
use PDO;

/**
 * Classe UnitDAO
 *
 * Gère les opérations de base de données pour les unités.
 */
class UnitDAO extends PDODAO
{
    /**
     * Récupère toutes les unités.
     *
     * @return array|null Retourne un tableau d'unités ou null si aucune unité n'est trouvée.
     * @throws Exception Si une erreur se produit lors de l'exécution de la requête.
     */
    public function getAll(): ?array
    {
        $sql = "SELECT * FROM unit";
        $stmt = $this->execRequest($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $units = null;

        if ($result != []) {
            $units = [];
            foreach ($result as $row) {
                $unit = new Unit();
                $unit->hydrate($row);

                $sqlOrigins = "SELECT id_origin FROM unitorigin WHERE id_unit = :id_unit";
                $stmtOrigins = $this->execRequest($sqlOrigins, ['id_unit' => $unit->getId()]);
                $origins = $stmtOrigins->fetchAll(PDO::FETCH_COLUMN);

                $unit->setOrigins($origins);
                $units[] = $unit;
            }
        }
        return $units;
    }

    /**
     * Récupère une unité par son ID.
     *
     * @param string $unitId L'ID de l'unité.
     * @return Unit|null Retourne l'unité ou null si elle n'est pas trouvée.
     * @throws Exception
     */
    public function read(string $unitId): ?Unit
    {
        $sql = "SELECT * FROM unit WHERE id = :id";
        $stmt = $this->execRequest($sql, ['id' => $unitId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data === false) {
            return null;
        }

        $unit = new Unit();
        $unit->hydrate($data);

        $sqlOrigins = "SELECT id_origin FROM unitorigin WHERE id_unit = :id_unit";
        $stmtOrigins = $this->execRequest($sqlOrigins, ['id_unit' => $unitId]);
        $origins = $stmtOrigins->fetchAll(PDO::FETCH_COLUMN);

        $unit->setOrigins($origins);
        return $unit;
    }

    /**
     * Supprime une unité par son ID.
     *
     * @param string $unitId L'ID de l'unité.
     * @return bool Retourne true si l'unité a été supprimée, sinon false.
     * @throws Exception
     */
    public function delete(string $unitId): bool
    {
        $unit = $this->read($unitId);
        if ($unit === null) {
            return false;
        }

        $sql = "DELETE FROM unit WHERE id = :id";
        $this->execRequest($sql, ['id' => $unitId]);
        return true;
    }

    /**
     * Met à jour une unité.
     *
     * @param Unit $unit L'unité à mettre à jour.
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     * @throws Exception
     */
    public function update(Unit $unit): bool
    {
        $unitId = $unit->getId();

        $sql = 'UPDATE unit SET name = ?, cost = ?, url_img = ? WHERE id = ?';
        $this->execRequest($sql, [
            $unit->getName(),
            $unit->getCost(),
            $unit->getUrlImg(),
            $unitId
        ]);

        $sqlDeleteOrigins = 'DELETE FROM unitorigin WHERE id_unit = ?';
        $this->execRequest($sqlDeleteOrigins, [$unitId]);

        foreach ($unit->getOrigins() as $originId) {
            $sqlInsertOrigin = 'INSERT INTO unitorigin (id_unit, id_origin) VALUES (?, ?)';
            $this->execRequest($sqlInsertOrigin, [$unitId, $originId]);
        }

        $updatedUnit = $this->read($unitId);

        return (
            $updatedUnit->getName() === $unit->getName() &&
            $updatedUnit->getCost() === $unit->getCost() &&
            $updatedUnit->getUrlImg() === $unit->getUrlImg() &&
            $updatedUnit->getOrigins() == $unit->getOrigins()
        );
    }

    /**
     * Crée une nouvelle unité.
     *
     * @param Unit $unit L'unité à créer.
     * @return bool Retourne true si l'unité a été créée, sinon false.
     * @throws Exception
     */
    public function create(Unit $unit): bool
    {
        $idUnit = uniqid();
        $sql = 'INSERT INTO unit (id, name, cost, url_img) VALUES (?, ?, ?, ?)';
        $this->execRequest($sql, [
            $idUnit,
            $unit->getName(),
            $unit->getCost(),
            $unit->getUrlImg()
        ]);

        foreach ($unit->getOrigins() as $origin) {
            $sql = 'INSERT INTO unitorigin (id_unit, id_origin) VALUES (?, ?)';
            $this->execRequest($sql, [$idUnit, $origin]);
        }

        return $this->read($idUnit) !== null;
    }

    /**
     * Recherche des unités par champ et terme.
     *
     * @param string $field Le champ à rechercher.
     * @param string $term Le terme de recherche.
     * @return array Retourne un tableau d'unités correspondant à la recherche.
     * @throws Exception
     */
    public function search(string $field, string $term): array
    {
        $sql = "SELECT * FROM unit WHERE $field LIKE :term";
        $stmt = $this->execRequest($sql, ['term' => '%' . $term . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $units = [];
        foreach ($results as $data) {
            $unit = new Unit();
            $unit->hydrate($data);
            $units[] = $unit;
        }
        return $units;
    }
}
