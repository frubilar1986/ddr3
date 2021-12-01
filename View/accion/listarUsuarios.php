<?php
include_once("../../config.php");
//$datosForm=datos_submitidos();
$abmUsuario = new AbmUsuario;
$colUsers=$abmUsuario->buscar(null);
//print_r($colUsers);
$arreglo_salida = array();
foreach($colUsers as $elem){
    $nuevoElem['idusuario']=$elem->getIdUsuario();
    $nuevoElem['usnombre']=$elem->getUsNombre();
    $nuevoElem['uspass']=$elem->getUsPass();
    $nuevoElem['usmail']=$elem->getUsMail();
    $nuevoElem['usdeshabilitado']=$elem->getUsDeshabilitado();
    array_push($arreglo_salida,$nuevoElem);
}
//funcion json_decode para  comboGrid(solo leen en json) en modulo de asignacion de roles de usuarion. 
// $json_string = json_encode($arreglo_salida);
//  $file = 'usuarios.json';
//  file_put_contents($file, $json_string);
echo json_encode($arreglo_salida);

?>