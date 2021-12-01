<?php
include_once('../../config.php');
$datos = data_submitted();
$resp = false;
if (isset($datos['idrol']) && isset($datos['idusuario'])) {
    $abmUsRol = new AbmUsuarioRol;
    $resp = $abmUsRol->baja($datos);
}
if (!$resp) {
    $retorno['errorMsj'] = "ERROR: No se puede eliminar el rol se usuarui ";
}
$retorno['respuesta'] = $resp;
//     $json_string = json_encode($datos);
//  $file = 'submit.json';
//  file_put_contents($file, $json_string);
echo json_encode($retorno);