<?php

namespace Models\DAO;

use Exception;
use PDO;
use Config\Config;
use PDOException;
use PDOStatement;

/**
 * Abstract class PDODAO
 *
 * Provides a base class for Data Access Objects (DAO) using PDO for database interactions.
 */
abstract class PDODAO
{
    private ?PDO $db = null;

    /**
     * Retrieves the PDO database connection.
     *
     * @return PDO The PDO instance for database connection.
     * @throws Exception If the database connection cannot be established.
     */
    private function getDB(): PDO
    {
        if ($this->db == null)
        {
            $dbConfig = Config::getDBConfig();

            $this->db = new PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['pass']);
        }
        return $this->db;
    }

    /**
     * Executes a SQL request with optional parameters.
     *
     * @param string $sql The SQL query to execute.
     * @param array|null $params Optional parameters for the SQL query.
     * @return PDOStatement|false The result of the query execution.
     * @throws Exception
     */
    protected function execRequest(string $sql, array $params = null): PDOStatement|false
    {
        try
        {
            $stmt = $this->getDB()->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
        catch (PDOException $e){
            echo'Erreur pour la requete: ' . $sql . PHP_EOL . $e->getMessage();
            return false;
        }
    }

    protected function getLastInsertedId(): int
    {
        return $this->getDB()->lastInsertId();
    }
}