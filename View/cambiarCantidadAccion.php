<?php $title = 'Cambiar Cantidad';
include_once './includes/head.php'; ?>

<?php
/* mostrarArray($_GET);
    mostrarArray($_SESSION); */
if (isset($_GET["idProd"]) && isset($_GET["cantidadProd"])) {
/*     mostrarArray($_GET);
    mostrarArray($_SESSION); */
/*     echo isset($_GET["id"]);
    echo isset($_GET["cantidad"]); */
    $control = new CarritoControl();
    $param["idProducto"] = $_GET["idProd"];
    $param["cantidadProducto"] = $_GET["cantidadProd"];
    $resp = $control->modificarCantidadProducto($param);
    header('Location: carritoCompra.php');
    exit;
}

?>