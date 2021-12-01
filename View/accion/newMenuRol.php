<?php
    include_once("../../config.php");
    $datos=data_submitted();
    $resp = false;
    // $datos['idmenu'] = 15;
    // $datos['idrol'] = 1;
    if (isset($datos['idmenu']) && isset($datos['idrol'])){
        // $datos['uspass'] = md5($datos['uspass']);
        $abm = new AbmMenuRol();
        $col = $abm->buscar(['idmenu' => $datos['idmenu'] , "idrol"=>$datos['idrol']]);
        if(count($col) == 0){
             
            $resp = $abm->alta($datos);
        }
    }

//mostrarArray($col);
$retorno['respuesta'] = $resp;
$retorno['errorMsg']="Error: El rol ya tiene permiso a ese menu.";
        // $json_string = json_encode($datos);
        //  $file = 'submit.json';
        // file_put_contents($file, $json_string);
    echo json_encode($retorno);
?>