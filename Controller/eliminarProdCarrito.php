<?php include_once '../View/includes/head.php'; ?>

<?php
if (isset(data_submitted()["id"])) {
    $control = new CarritoControl();
    $param["idProducto"] = data_submitted()["id"];
    $resp = $control->eliminarProducto($param);
    header('Location: ../View/carritoCompra.php');
    exit;
}

?>
