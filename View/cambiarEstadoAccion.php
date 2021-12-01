<?php $title = 'Cambio Estado';
include_once './includes/head.php'; ?>

<?php
mostrarArray(data_submitted());
// mostrarArray($_POST);
$resp = false;
// mostrarArray(data_submitted());
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
header('Location: estadoCompra.php');

// echo $resp;
// mostrarArray(($compraEstado));
?>

