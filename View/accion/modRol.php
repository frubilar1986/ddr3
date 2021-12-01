<?php
include_once("../../config.php");
$datos = data_submitted();
$resp = false;
if (isset($datos['idrol']) && isset($datos['rodescripcion'])) {
    $abmRol = new abmRol();
    $resp = $abmRol->modificacion($datos);
} 
if(!$resp){

    $retorno['errorMsg'] = "error: Fallo la modificacion del rol";
}

$retorno['respuesta'] = $resp;
echo json_encode($retorno);
?>