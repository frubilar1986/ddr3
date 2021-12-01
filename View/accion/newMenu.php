<?php
include_once("../../config.php");
$datos = data_submitted();
$resp = false;
// $datos['menombre'] = 'help';
// $datos['medescripcion'] = 'helppp';
// $datos['medeshabilitado'] = null;
// $datos['idpadre'] = 3;

if (isset($datos['menombre'])) {
   
    $abmMenu = new AbmMenu;
   
    $resp = $abmMenu->alta($datos);
           
} else {
    $resp = false;
    $retorno['errorMsg'] = "Error al crear nuevo menu";
}
$retorno['respuesta'] = $resp;
//     $json_string = json_encode($datos);
//  $file = 'submit.json';
//  file_put_contents($file, $json_string);
echo json_encode($retorno);

?>
