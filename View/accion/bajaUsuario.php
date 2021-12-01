<?php
include_once("../../config.php");
$datos = data_submitted();
$resp = false;

if ($datos['usdeshabilitado'] == "null") {

    $datos['usdeshabilitado'] = date('Y-m-d H:i:s');
} else {
    $datos['usdeshabilitado'] = null;
}

$abmUsuario = new abmUsuario();

$resp = $abmUsuario->modificacion($datos);
//} 
if (!$resp) {

    $retorno['errorMsg'] = "error al dar de baja el usuario wey";
}
$retorno['respuesta'] = $resp;
echo json_encode($retorno);
