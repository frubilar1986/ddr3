<?php
    include_once("../../config.php");
    $datos=data_submitted();
    $resp = false;
    if (isset($datos['usnombre']) && isset($datos['uspass'])){
        $datos['uspass'] = md5($datos['uspass']);
        $abmUsuario = new abmUsuario();
        $col = $abmUsuario->buscar(['usnombre' => $datos['usnombre']]);
        if(count($col) == 0){
             
            $resp = $abmUsuario->alta($datos);
        }
    }


$retorno['respuesta'] = $resp;
$retorno['errorMsg']="Error: Nombre de usuario ya existe existente";
        // $json_string = json_encode($datos);
        //  $file = 'submit.json';
        // file_put_contents($file, $json_string);
    echo json_encode($retorno);
?>