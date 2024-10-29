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
     * @return array|false Retourne un tableau d'unités ou false si aucune unité n'est trouvée.
     * @throws Exception Si une erreur se produit lors de l'exécution de la requête.
     */
    public function getAll(): array|false
    {
        $sql = "SELECT * FROM unit";
        $stmt = $this->execRequest($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $units = false;
        if ($result != [])
        {
            $units = [];
            foreach ($result as $row) {
                $unit = new Unit();
                $unit->hydrate($row); // Utilisez la méthode hydrate pour peupler l'objet
                $units[] = $unit;
            }
        }
        return $units;
    }

    /**
     * Récupère une unité par son identifiant.
     *
     * @param string $id L'identifiant de l'unité.
     * @return Unit|false Retourne un Unit ou false si aucune unité n'est trouvée.
     * @throws Exception si une erreur se produit lors de l'exécution de la requête, si l'id n'existe pas.
     */
    public function read(string $unitId): ?Unit
    {
        $sql = "SELECT * FROM unit WHERE id = :id";
        $stmt =  $this->execRequest($sql, ['id' => $unitId]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifie si le résultat est `false`, indiquant qu'aucune unité n'a été trouvée
        if ($data === false) {
            return null; // Aucun résultat trouvé, retourne `null`
        }

        $unit = new Unit();
        $unit->hydrate($data); // Hydrate l'unité avec les données trouvées
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
        // Préparation de la requête SQL pour mettre à jour l'unité
        $sql = 'UPDATE unit SET name = ?, cost = ?, origin = ?, url_img = ? WHERE id = ?';
        $stmt = $this->execRequest($sql, [
            $unit->getName(),
            $unit->getCost(),
            $unit->getOrigin(),
            $unit->getUrlImg(),
            $unit->getId()
        ]);

        // Vérification de la mise à jour en lisant de nouveau l'unité dans la base de données
        $updatedUnit = $this->read($unit->getId());

        // Vérification que toutes les propriétés de l'unité en base de données correspondent à celles de l'unité d'origine
        return (
            $updatedUnit->getName() === $unit->getName() &&
            $updatedUnit->getCost() === $unit->getCost() &&
            $updatedUnit->getOrigin() === $unit->getOrigin() &&
            $updatedUnit->getUrlImg() === $unit->getUrlImg()
        );
    }

    public function create(Unit $unit): bool
    {
        $result = false;
        $lastEntry = $this->read($this->getLastInsertedId());

        // Préparation de la requête SQL pour insérer une nouvelle unité
        $sql = 'INSERT INTO unit (name, cost, origin, url_img) VALUES (?, ?, ?, ?)';

        // Exécution de la requête avec les valeurs de l'objet Unit
        $stmt = $this->execRequest($sql, [
            $unit->getName(),
            $unit->getCost(),
            $unit->getOrigin(),
            $unit->getUrlImg()
        ]);

        if($this->read($this->getLastInsertedId())->getId() != $lastEntry->getId())
            $result = true;

        return $result;
    }



}