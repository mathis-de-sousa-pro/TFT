<?php

require_once 'Helpers/Psr4AutoloaderClass.php';
require_once 'Controllers/MainController.php';

use Controllers\MainController;
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

$mainController->index();

if(!empty($_GET['action']))
   if (isset($_GET["action"])){
       switch ($_GET["ection"]){
           case "add-unit": $mainController->addUnit();
           case "search":
           default: $mainController->index();

       }
   }
