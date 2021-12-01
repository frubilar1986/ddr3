<?php
include_once("../../config.php");
$data = data_submitted();
$resp = false;
// $data['idmenu'] = 13;
// $data['medescripcion'] = "";
// $data['idpadre'] = "Menu Administrador";
// $data['medeshabilitado'] = "" ;
if (isset($data['idmenu'])) {
    if ($data['medeshabilitado'] == "null") {
        $data['medeshabilitado'] = date("Y-m-d H:i:s");
        
    } else {
        $data['medeshabilitado'] = null;
       
    }
    $abmMenu = new AbmMenu;
    $data = $abmMenu->buscarIdPadre($data);
    $resp = $abmMenu->modificacion($data);
}

if (!$resp) {
    $retorno['errorMsg'] = "No se elinmino el registro";
}
$retorno['respuesta'] = $resp;
//$retorno['errorMsg'] = $msj;
// $json_string = json_encode($data);
// $file = 'submit.json';
// file_put_contents($file, $json_string);
//
echo json_encode($retorno);
