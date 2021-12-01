<?php

include_once("../../config.php");
$datos = data_submitted();

$resp = true;
// eliminar los registros con la key de rol en la tablas que se relaciona
//eliminar rol
//$datos['idrol'] = 3;
if (isset($datos['idrol'])) {
    $abmUsRol = new AbmUsuarioRol;
    $colUsuarioRol = $abmUsRol->buscar(['idrol' => $datos['idrol']]);
    //mostrarArray($colUsuarioRol);
    if (count($colUsuarioRol) != 0) {
        foreach ($colUsuarioRol as $usRol) {
            $arr['idusuario'] = $usRol->getObjUsuario()->getIdUsuario();
            $arr['idrol'] = $usRol->getObjRol()->getIdRol();
            //$resp = $usRol->baja($arr);
            //mostrarArray($usRol);
            //mostrarArray($arr);
            $resp = $abmUsRol->baja($arr);
        }
    }
    if ($resp) {

        $abmMenuRol = new AbmMenuRol;
        $colMenuRol = $abmMenuRol->buscar(['idrol' => $datos['idrol']]);
        //     mostrarArray($colMenuRol);
        if (count($colMenuRol) != 0) {
            foreach ($colMenuRol as $menuRol) {
                $arr1['idmenu'] = $menuRol->getObjMenu()->getIdMenu();
                $arr1['idrol'] = $menuRol->getObjRol()->getIdRol();
                $resp = $abmMenuRol->baja($arr1);
            }
        }
    }
    if ($resp) {
        $abmRol = new AbmRol;
        $resp = $abmRol->baja(["idrol" => $datos['idrol']]);
    }
};

if (!$resp) {

    $retorno['errorMsg'] = "ERROR: No se elimino el rol";
}
$retorno['respuesta'] = $resp;
echo json_encode($retorno);
?>
