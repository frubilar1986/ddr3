<?php
    include_once('../../config.php');
    $data = data_submitted();
    $abmMenu = new AbmMenu;
    $colMenus = $abmMenu->buscar($data);
    $arrSalida = array();
    foreach($colMenus as $menu){
        $newElem['idmenu'] = $menu->getIdMenu();
        $newElem['menombre'] = $menu->getMeNombre();
        $newElem['medescripcion'] = $menu->getMeDescripcion();
        $newElem['idpadre'] = $menu->getObjMePadre();
            if($newElem['idpadre'] != null ){
                $newElem['idpadre'] = $menu->getObjMePadre()->getMeNombre();
            }
        $newElem['medeshabilitado'] = $menu->getMeDeshabilitado();
        array_push($arrSalida,$newElem);
    }
    //mostrarArray($arrSalida);
    echo json_encode($arrSalida);
    //print_r($arrSalida);
?>