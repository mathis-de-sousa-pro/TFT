<?php

namespace Models\DAO;

use Exception;
use Models\Unit;
use PDO;

/**
 * Classe UnitDAO
 *
 * Cette classe gère les opérations de base de données pour les unités.
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
        if ($result != [])
        {
            $units = [];
            foreach ($result as $row) {
                $unit = new Unit();
                $unit->hydrate($row);

                // Récupération des origines associées dans `unitorigin`
                $sqlOrigins = "SELECT id_origin FROM unitorigin WHERE id_unit = :id_unit";
                $stmtOrigins = $this->execRequest($sqlOrigins, ['id_unit' => $unit->getId()]);
                $origins = $stmtOrigins->fetchAll(PDO::FETCH_COLUMN);
                // Ajout des origines à l'unité
                $unit->setOrigins($origins);

                $units[] = $unit;
            }
        }
        return $units;
    }

    public function read(string $unitId): ?Unit
    {
        // Récupération des informations de base de l'unité dans `unit`
        $sql = "SELECT * FROM unit WHERE id = :id";
        $stmt = $this->execRequest($sql, ['id' => $unitId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data === false) {
            return null; // Retourne null si l'unité n'est pas trouvée
        }

        // Création de l'objet `Unit` et hydratation des données de base
        $unit = new Unit();
        $unit->hydrate($data);

        // Récupération des origines associées dans `unitorigin`
        $sqlOrigins = "SELECT id_origin FROM unitorigin WHERE id_unit = :id_unit";
        $stmtOrigins = $this->execRequest($sqlOrigins, ['id_unit' => $unitId]);
        $origins = $stmtOrigins->fetchAll(PDO::FETCH_COLUMN);
        // Ajout des origines à l'unité
        $unit->setOrigins($origins);

        return $unit;
    }

    public function delete(string $unitId): bool
    {
        // Vérifie si l'unité existe avant de tenter la suppression
        $unit = $this->read($unitId);
        if ($unit === null) {
            // L'unité n'existe pas, retourne `false` ou génère une exception
            return false;
        }

        // Supprime l'unité si elle existe
        $sql = "DELETE FROM unit WHERE id = :id";
        $stmt = $this->execRequest($sql, ['id' => $unitId]);
        return true;
    }

    public function update(Unit $unit): bool
    {
        $unitId = $unit->getId();

        // Mise à jour des informations de l'unité dans la table `unit`
        $sql = 'UPDATE unit SET name = ?, cost = ?, url_img = ? WHERE id = ?';
        $stmt = $this->execRequest($sql, [
            $unit->getName(),
            $unit->getCost(),
            $unit->getUrlImg(),
            $unitId
        ]);

        // Gestion des origines dans la table `unitorigin`

        // Suppression des origines actuelles pour cette unité
        $sqlDeleteOrigins = 'DELETE FROM unitorigin WHERE id_unit = ?';
        $this->execRequest($sqlDeleteOrigins, [$unitId]);

        // Ajout des nouvelles origines
        foreach ($unit->getOrigins() as $originId) {
            $sqlInsertOrigin = 'INSERT INTO unitorigin (id_unit, id_origin) VALUES (?, ?)';
            $this->execRequest($sqlInsertOrigin, [$unitId, $originId]);
        }

        // Vérification de la mise à jour en lisant de nouveau l'unité dans la base de données
        $updatedUnit = $this->read($unitId);

        // Comparaison des propriétés mises à jour avec celles en base de données
        return (
            $updatedUnit->getName() === $unit->getName() &&
            $updatedUnit->getCost() === $unit->getCost() &&
            $updatedUnit->getUrlImg() === $unit->getUrlImg() &&
            $updatedUnit->getOrigins() == $unit->getOrigins()
        );
    }

    public function create(Unit $unit): bool
    {
        $result = false;

        // gestion de la table unit
        $idUnit = uniqid();
        $sql = 'INSERT INTO unit (id, name, cost, url_img) VALUES (?, ?, ?, ?)';

        $stmt = $this->execRequest($sql, [
            $idUnit,
            $unit->getName(),
            $unit->getCost(),
            $unit->getUrlImg()
        ]);

        //gestion de la table unitorigin
        $origins = $unit->getOrigins();

        foreach ($origins as $origin)
        {
            $sql = 'INSERT INTO unitorigin (id_unit, id_origin) VALUES (?, ?)';
            $stmt = $this->execRequest($sql, [$idUnit, $origin]);
        }



        if ($this->read($idUnit) != null)
            $result = true;

        return $result;
    }

    public function search(string $field, string $term): array
    {
        // Requête pour rechercher dans le champ spécifié
        $sql = "SELECT * FROM unit WHERE $field LIKE :term";
        $stmt = $this->execRequest($sql, ['term' => '%' . $term . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Hydratation des résultats en objets Unit
        $units = [];
        foreach ($results as $data) {
            $unit = new Unit();
            $unit->hydrate($data);
            $units[] = $unit;
        }

        return $units;
    }
}