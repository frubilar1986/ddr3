<?php
//include_once('../config.php');

class CtrolPagina
{

    function ctrl_acceso($param,$nomPag)
    {
        $ctrolMenu = new AbmMenu;
        $objMenu = $ctrolMenu->buscar(['menombre'=>$nomPag]);
        $idMenu = $objMenu[0]->getIdMenu();
        $resp = false;
       

        if (isset($param['idmenu'])) {
            $abmMenuRol = new AbmMenuRol;
            $col = $abmMenuRol->buscar(['idmenu' => $idMenu, 'idrol' => $param['rol']]);

            if (count($col) != 0) {
                $resp = true;
            }
        }
        return $resp;
    }
}
