<?php 
session_start();
$solicitud = $_SERVER['REQUEST_URI'];
if ($solicitud=="/") header('Location: /site/home');

require_once "settings.php";
require_once "core/dblayer.php";
require_once "core/collector.php";
require_once "core/standardobject.php";
require_once "core/standardview.php";
require_once "core/standardcontroller.php";
require_once "core/sessions.php";

$array = explode("/", $solicitud);

$modulo = (isset($array[1]) && $array[1] != '' ) ? $array[1] : 'site' ;
$recurso = (isset($array[2])&& $array[2] != '') ? $array[2] : 'home' ;
$arg = (isset($array[3])) ? $array[3] : 0 ;

settype($arg, 'int');

$file = "modules/".strtolower($modulo).".php";

if (file_exists($file)) require_once $file;
$c = ucwords($modulo)."Controller";
if (class_exists($c)) $controller = new $c();
if (method_exists($c, $recurso)) $controller->$recurso($arg);

?>