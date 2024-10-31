<?php

namespace Models\DAO;

use Exception;
use PDO;
use Config\Config;
use PDOException;
use PDOStatement;

/**
 * Classe abstraite PDODAO
 *
 * Fournit une base pour les objets d'accès aux données (DAO) utilisant PDO pour les interactions avec la base de données.
 */
abstract class PDODAO
{
    /**
     * @var ?PDO $db
     * Instance de connexion à la base de données.
     */
    private ?PDO $db = null;

    /**
     * Récupère la connexion PDO à la base de données.
     *
     * @return PDO L'instance PDO de la connexion à la base de données.
     * @throws Exception Si la connexion à la base de données ne peut être établie.
     */
    private function getDB(): PDO
    {
        if ($this->db === null) {
            $dbConfig = Config::getDBConfig();
            $this->db = new PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['pass']);
        }
        return $this->db;
    }

    /**
     * Exécute une requête SQL avec des paramètres optionnels.
     *
     * @param string $sql La requête SQL à exécuter.
     * @param array|null $params Les paramètres optionnels pour la requête SQL.
     * @return PDOStatement|false Le résultat de l'exécution de la requête ou false en cas d'échec.
     * @throws Exception
     */
    protected function execRequest(string $sql, array $params = null): PDOStatement|false
    {
        try {
            $stmt = $this->getDB()->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            echo 'Erreur pour la requête: ' . $sql . PHP_EOL . $e->getMessage();
            return false;
        }
    }
}
