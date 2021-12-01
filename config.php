<?php

header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO = 'ddr3';

//variable que almacena el directorio del proyecto
$ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECTO/";
$LOGIN = "../View/login.php";
$INICIO = "../View/comprar.php";

include_once($ROOT . 'Util/funciones.php');

$GLOBALS['ROOT'] = $ROOT;

$sesion = new Session;

