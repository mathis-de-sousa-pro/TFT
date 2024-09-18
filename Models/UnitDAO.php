<?php

namespace Models;

use Exception;

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
        $result = $stmt->fetchAll();
        return ! empty($result) ? $result : false;
    }

    /**
     * Récupère une unité par son identifiant.
     *
     * @param string $id L'identifiant de l'unité.
     * @return array|null Retourne un tableau contenant les informations de l'unité ou null si aucune unité n'est trouvée.
     * @throws Exception si une erreur se produit lors de l'exécution de la requête, si l'id n'existe pas.
     */
    public function getById(string $id): array|null
    {
        $sql = 'SELECT * FROM unit WHERE id = ?';
        $stmt = $this->execRequest($sql, [$id]);
        $result = $stmt->fetch();
        return ! empty($result) ? $result : null;
    }
}