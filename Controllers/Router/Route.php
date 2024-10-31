<?php

namespace Controllers\Router;

use Exception;

/**
 * Classe Route
 *
 * Classe abstraite qui définit la structure pour le routage.
 */
abstract class Route
{
    /**
     * Détermine la méthode à utiliser (GET ou POST) et appelle le gestionnaire de route approprié.
     *
     * @param array $params
     * Les paramètres pour la route.
     * @param string $method
     * La méthode HTTP à utiliser (par défaut 'GET').
     *
     * @return void
     */
    public function action(array $params, string $method = 'GET'): void
    {
        if ($_SERVER['REQUEST_METHOD'] == $method) {
            $this->getRoute($params);
        } else {
            $this->postRoute($params);
        }
    }

    /**
     * Retourne le paramètre s'il existe, sinon lève une exception.
     *
     * @param array $array
     * Le tableau contenant les paramètres.
     * @param string $paramName
     * Le nom du paramètre à récupérer.
     * @param bool $canBeEmpty
     * Indique si le paramètre peut être vide (par défaut true).
     *
     * @return string
     * La valeur du paramètre.
     *
     * @throws Exception
     * Si le paramètre est manquant ou vide (lorsque $canBeEmpty est false).
     */
    public function getParam(array $array, string $paramName, bool $canBeEmpty = true): string
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Le paramètre '$paramName' est vide");
            }
            return $array[$paramName];
        } else {
            throw new Exception("Le paramètre '$paramName' est manquant");
        }
    }

    /**
     * Gère les requêtes GET pour la route.
     *
     * @param array $params
     * Les paramètres pour la route.
     *
     * @return void
     */
    abstract public function getRoute(array $params): void;

    /**
     * Gère les requêtes POST pour la route.
     *
     * @param array $params
     * Les paramètres pour la route.
     *
     * @return void
     */
    abstract public function postRoute(array $params): void;
}
