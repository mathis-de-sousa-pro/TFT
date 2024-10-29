<?php

require_once 'Helpers/Psr4AutoloaderClass.php';
require_once 'Controllers/MainController.php';

use Controllers\MainController;
use Controllers\Router\Router;
use Helpers\Psr4AutoloaderClass;

$loader = new Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('\Helpers', 'Helpers');
$loader->addNamespace('\League\Plates', 'Vendor/Plates/src');
$loader->addNamespace('\Controllers', 'Controllers');
$loader->addNamespace('\Models', 'Models');
$loader->addNamespace('\Config', 'Config');
$loader->addNamespace('\Views', 'Views');
$mainController = new MainController();

$router = new Router("action");
$router->routing($_GET, $_POST);

