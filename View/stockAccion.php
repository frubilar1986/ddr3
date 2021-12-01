<?php
include_once "../config.php";

$data = data_submitted();

$abmProducto = new AbmProducto();
$producto = $abmProducto->buscar(['idproducto' => $data['idproducto']])[0];

$datos = [
  'idproducto' => $producto->getIdProducto(),
  'pronombre' => $producto->getProNombre(),
  'prodetalle' => str_replace("'", "''", $producto->getProDetalle()),
  'procantstock' => $data['procantstock'],
  'proprecio' => $producto->getProPrecio(),
  'propreciooferta' => ($producto->getProPrecioOferta() == null) ? null : $producto->getProPrecioOferta(),
  'prodeshabilitado' => ($producto->getProDeshabilitado() == null) ? null : $producto->getProDeshabilitado()
];

var_dump($datos);

$abmProducto->modificacion($datos);

header("Status: 301 Moved Permanently");
header("Location: stock.php");
