<?php $title = 'Cambio Estado';
include_once '../View/includes/head.php'; ?>

<?php
$resp = false;
$abmCompraEstado = new AbmCompraEstado();
$paramIdCompra["idcompra"] = data_submitted()["idcompra"];
$nuevoEstado = data_submitted()["nuevoestado"];
$compraEstado = $abmCompraEstado->buscar($paramIdCompra)[0];
$datos = [
    "idcompraestado" => $compraEstado->getIdCompraEstado(),
    "idcompra" => $compraEstado->getObjCompra()->getIdCompra(),
    "idcompraestadotipo" => $nuevoEstado,
    "cefechaini" => $compraEstado->getCeFechaIni(),
    "cefechafin" => " null",
];
$resp = $abmCompraEstado->modificacion($datos);
echo $resp;
header('Location: ../View/estadoCompra.php');
?>

