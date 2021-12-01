<?php
//include_once('../config.php');

class ctrolPagina
{

    function ctrl_acceso($param)
    {

        $resp = false;
       

        if (isset($param['idmenu'])) {
            $abmMenuRol = new AbmMenuRol;
            $col = $abmMenuRol->buscar(['idmenu' => $param['idmenu'], 'idrol' => $param['rol']]);

            if (count($col) != 0) {
                $resp = true;
            }
        }
        return $resp;
    }
}
