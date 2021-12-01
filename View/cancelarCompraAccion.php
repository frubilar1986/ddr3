<?php $title = 'Estado de Compra';
include_once './includes/head.php'; ?>

<?php
// mostrarArray($_POST);
$resp = false;
// mostrarArray(data_submitted());
$abmCompraEstado = new AbmCompraEstado();
$paramIdCompra["idcompra"] = data_submitted()["idcompracancelar"];
$compraEstado = $abmCompraEstado->buscar($paramIdCompra);

/* Traigo los compraitem para devolver el stock a los item */
$abmCompraItem = new AbmCompraItem();
$arrCompraItem = $abmCompraItem->buscar($paramIdCompra);
// mostrarArray($arrCompraItem);

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
header('Location: http://localhost/PWD_TPFinal/View/estadoCompra.php');

// echo $resp;
// mostrarArray(($compraEstado));
?>