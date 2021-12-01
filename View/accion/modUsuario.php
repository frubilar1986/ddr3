<?php
    include_once("../../config.php");
    $datos = data_submitted();
    //print_r($datos);
    $resp = false;
    if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail'])){
        if($datos['usdeshabilitado'] == "null"){
            $datos['usdeshabilitado'] = null;
        }
        $abmUs=new abmUsuario();
        $resp=$abmUs->modificacion($datos);
    }
        if(!$resp){
        
        $retorno['errorMsg']="fallo la modificacion!!!";
    }
    $retorno['respuesta'] = $resp;
    echo json_encode($retorno);
    
?>