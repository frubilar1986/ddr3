<?php
include_once('../../config.php');
$data = data_submitted();
$resp = false;
if (isset($data['idmenu'])) {
    if ($data['medeshabilitado'] == 'null') {
        $data['medeshabilitado'] = null;
    }
    $abmMenu = new AbmMenu;
    $data = $abmMenu->buscarIdPadre($data);
    $resp =  $abmMenu->modificacion($data);
}
if (!$resp) {
    $msj = "la modificacion fallo";
}
$retorno['respuesta'] = $resp;

// $retorno['errorMsg'] = $msj;
// $json_string = json_encode($data);
// $file = 'submit.json';
//file_put_contents($file, $json_string);
    echo json_encode($retorno);
