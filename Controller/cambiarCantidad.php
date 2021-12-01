<?php $title = 'Cambiar Cantidad';
include_once '../View/includes/head.php';?>


<?php

if (isset(data_submitted()["idProd"]) && isset(data_submitted()["cantidadProd"])) {
    if(is_numeric(data_submitted()["cantidadProd"])) {
        $control = new CarritoControl();
        $param["idProducto"] = data_submitted()["idProd"];
        $param["cantidadProducto"] = data_submitted()["cantidadProd"];
        $resp = $control->modificarCantidadProducto($param);
    }
    header('Location: ../View/carritoCompra.php');
    exit;
}

?>