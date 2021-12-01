<?php
include_once('../../config.php');
$datos = data_submitted();
// $datos['idrol'] = 1;
// $datos['idusuario'] = 5;
$resp = false;
$existeRol = false;
if (isset($datos['idrol']) && isset($datos['idusuario'])) {
    $abmUsRol = new AbmUsuarioRol();
    $col = $abmUsRol->buscar(['idusuario' => $datos['idusuario']]);
    foreach($col as $elem){
        if($elem->getObjRol()->getIdRol() == $datos['idrol']){
                $existeRol = true;
        }
    }
}
if ( !$existeRol) {
    
    $resp = $abmUsRol->alta($datos);
    // $resp = true;
}
if(!$resp){

    $retorno['errorMsg'] = "Error: El usuario seleccionado ya tiene este rol";
}
$retorno['respuesta'] = $resp;
echo json_encode($retorno);

// $json_string = json_encode($datos);
//  $file = 'submit.json';
//  file_put_contents($file, $json_string);
//$('#dlgRolUs').dialog('close'), $('#dgRolUs').datagrid('reload', 'accion/listarUsRol.php'