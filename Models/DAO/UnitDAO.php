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
    public function read(string $id): Unit|false
    {
        $sql = 'SELECT * FROM unit WHERE id = ?';
        $stmt = $this->execRequest($sql, [$id]);
        if (!$stmt)
            $result = false;
        else
        {
            $result = new Unit();
            $result->hydrate($stmt->fetch());
        }
        return $result;
    }

    /**
     * @throws Exception si une erreur se produit lors de la suppression de l'élément
     */
    public function delete(int $id): bool
    {
        $result = false;
        $sql = 'DELETE FROM unit WHERE id = ?';
        $stmt = $this->execRequest($sql, [$id]);

        if (!$this->read($id))
            $result = true;

        return $result;
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