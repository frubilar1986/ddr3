<?php
    include_once('../../config.php');
    $datas = data_submitted();
    $data['idpadre'] = null;
    $abm = new AbmMenu;
    $col = $abm->buscar(null);
    $arr  = array();
    foreach($col as $element){
        if(!$element->getobjmepadre() ){
            $newElelm['idmenu'] = $element->getIdMenu();
            $newElelm['menombre'] = $element->getMeNombre();
            array_push($arr,$newElelm);
        }
       // $newElem['idpadre'] = $menu->getObjMePadre()->getIdMenu();
        //$newElelm['menombre'] = $element->getMeNombre();
    }
     echo json_encode($arr);
   // mostrarArray($arr);
?>