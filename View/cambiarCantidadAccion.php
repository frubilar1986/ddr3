<?php $title = 'Cambiar Cantidad';
include_once './includes/head.php'; ?>

<?php

if (isset($_GET["idProd"]) && isset($_GET["cantidadProd"])) {

    $control = new CarritoControl();
    $param["idProducto"] = $_GET["idProd"];
    $param["cantidadProducto"] = $_GET["cantidadProd"];
    $resp = $control->modificarCantidadProducto($param);
    header('Location: carritoCompra.php');
    exit;
}

?>