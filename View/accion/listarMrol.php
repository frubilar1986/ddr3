<?php
include_once("../../config.php");

//$datos = data_submitted();

$abm = new AbmMenuRol;
//$datos['idusuario'] = 5;
if (isset($datos['idmenu'])) {

    $col = $abm->buscar(['idmenu' => $datos['idmenu']]);
} else {
    $col = $abm->buscar(null);
}
//print_r($colUsers);
$arreglo_salida = array();
foreach ($col as $elem) {
    $nuevoElem['idmenu'] = $elem->getObjMenu()->getIdMenu();
    $nuevoElem['menombre'] = $elem->getObjMenu()->getMeNombre();
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
