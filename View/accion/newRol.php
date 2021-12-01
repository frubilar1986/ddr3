<?php
include_once("../../config.php");
$datos = data_submitted();
$resp = false;
if (isset($datos['idrol']) && isset($datos['rodescripcion'])) {

    $abmRol = new AbmRol;
    if($resp = $abmRol->alta($datos)){
        $resp = true;
    }else{
        $retorno['errorMsg'] = "error un nuevo rol";
    }
    

} 
if (!$resp){}
$retorno['respuesta'] = $resp;
echo json_encode($retorno);
?>