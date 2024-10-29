<?php

namespace Controllers\Router;

use Exception;

/**
 * Class Route
 *
 * Abstract class that defines the structure for routing.
 *
 */
abstract class Route
{
    /**
     * Route constructor.
     */
    public function __construct()
    {
    }

    /**
     * Determines the method to be used (GET or POST) and calls the appropriate route handler.
     *
     * @param array $params The parameters for the route.
     * @param string $method The HTTP method to be used (default is 'GET').
     * @return void
     */
    public function action($params, $method='GET')
    {
        if($_SERVER['REQUEST_METHOD'] == $method)
        {
            $this->getRoute($params);
        }
        else
        {
            $this->postRoute($params);
        }
    }

    /**
     * Return parameter if it exists, otherwise throw an exception.
     *
     * @param array $array The array containing the parameters.
     * @param string $paramName The name of the parameter to retrieve.
     * @param bool $canBeEmpty Whether the parameter can be empty (default is true).
     * @return mixed The value of the parameter.
     * @throws Exception If the parameter is missing or empty (when $canBeEmpty is false).
     */
    public function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if(!$canBeEmpty && empty($array[$paramName]))
                throw new Exception("Parameter '$paramName' empty");
            return $array[$paramName];
        } else
            throw new Exception("Parameter '$paramName' missing");
    }

    /**
     * Handle GET requests for the route.
     *
     * @param array $params The parameters for the route.
     * @return void
     */
    public abstract function getRoute(array $params): void;

    /**
     * Handle POST requests for the route.
     *
     * @param array $params The parameters for the route.
     * @return void
     */
    public abstract function postRoute(array $params): void;
}