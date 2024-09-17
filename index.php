<?php

use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine as Engine;

require_once 'Helpers/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass();
$loader -> register();

$loader -> addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/Plates/src');
$loader->addNamespace('\Controllers', '/Controllers');

$engine = new Engine('./Views');
$test = "testons";
$engine->render('home', ['tftSetName' => "test"]);