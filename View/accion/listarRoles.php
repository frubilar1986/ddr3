<?php
include_once("../../config.php");
//$datosForm=datos_submitidos();
$abmRoles = new AbmRol;
$col=$abmRoles->buscar(null);
//print_r($colUsers);
$arreglo_salida = array();
foreach($col as $elem){
    $nuevoElem['idrol']=$elem->getIdRol();
    $nuevoElem['rodescripcion']=$elem->getRoDescripcion();
   
    array_push($arreglo_salida,$nuevoElem);
}
//mostrarArray($col);
// $json_string = json_encode($arreglo_salida);//necesario para comboGrid al agregar rol a un usuario
//  $file = 'roles.json';
//  file_put_contents($file, $json_string);
echo json_encode($arreglo_salida);

?>