<?php include_once "../config.php";
include_once '../View/includes/head.php'; ?>


<?php
$resp = false;
$abmCompraEstado = new AbmCompraEstado();
$paramIdCompra["idcompra"] = data_submitted()["idcompracancelar"];
$compraEstado = $abmCompraEstado->buscar($paramIdCompra);

$abmCompraItem = new AbmCompraItem();
$arrCompraItem = $abmCompraItem->buscar($paramIdCompra);

$abmProducto = new AbmProducto();

$datos = [
    "idcompraestado" => $compraEstado[0]->getIdCompraEstado(),
    "idcompra" => $_POST["idcompracancelar"],
    "idcompraestadotipo" => 4,
    "cefechaini" => $compraEstado[0]->getCeFechaIni(),
    "cefechafin" =>  fecha(),
];

foreach($arrCompraItem as $compraItem) {
    $idProd["idproducto"] = $compraItem->getObjProducto()->getIdProducto();
    $objProducto = $abmProducto->buscar($idProd)[0];
    $datosProducto = [
        'idproducto' => $objProducto->getIdProducto(),
        'pronombre' => $objProducto->getProNombre(),
        'prodetalle' => str_replace("'", "''", $objProducto->getProDetalle()),
        'procantstock' => $objProducto->getProCantStock() + $compraItem->getCiCantidad(),
        'proprecio' => $objProducto->getProPrecio(),
        'propreciooferta' => ($objProducto->getProPrecioOferta() == null) ? "null" : $objProducto->getProPrecioOferta(),
        'prodeshabilitado' => $objProducto->getProDeshabilitado(),
    ];
    $respStock = $abmProducto->modificacion($datosProducto);
    
}


$resp = $abmCompraEstado->modificacion($datos);
header('Location: ../View/estadoDeCompra.php');

?>