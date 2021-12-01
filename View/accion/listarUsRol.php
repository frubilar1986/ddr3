<?php
include_once("../../config.php");

$datos = data_submitted();

$abm = new AbmUsuarioRol;
//$datos['idusuario'] = 5;
if (isset($datos['idusuario'])) {

    $col = $abm->buscar(['idusuario' => $datos['idusuario']]);
} else {
    $col = $abm->buscar(null);
}
//print_r($colUsers);
$arreglo_salida = array();
foreach ($col as $elem) {
    $nuevoElem['idusuario'] = $elem->getObjUsuario()->getIdusuario();
    $nuevoElem['usnombre'] = $elem->getObjUsuario()->getUsNombre();
    $nuevoElem['idrol'] = $elem->getObjRol()->getIdRol();
    $nuevoElem['rodescripcion'] = $elem->getObjRol()->getRoDescripcion();
    // $nuevoElem['mail']=$elem->getObjUsuario()->getUSMail();

    array_push($arreglo_salida, $nuevoElem);
}
//mostrarArray($coleccion);
// $json_string = json_encode($arreglo_salida);
//  $file = 'roles.json';
//  file_put_contents($file, $json_string);
echo json_encode($arreglo_salida);
