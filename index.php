<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Controllers\MainController;
use Helpers\Psr4AutoloaderClass;

require_once 'Helpers/Psr4AutoloaderClass.php';
require_once 'Controllers/MainController.php';

$loader = new Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('\Helpers', 'Helpers');
$loader->addNamespace('\League\Plates', 'Vendor/Plates/src');
$loader->addNamespace('\Controllers', 'Controllers');
$loader->addNamespace('\Models', 'Models');
$loader->addNamespace('\Config', 'Config');
$mainController = new MainController();

$mainController->index();
