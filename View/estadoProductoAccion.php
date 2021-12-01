<?php
include_once "../config.php";

$data = data_submitted();

$abmProducto = new AbmProducto();
$producto = $abmProducto->buscar(['idproducto' => $data['id']])[0];

$datos = [
  'idproducto' => $producto->getIdProducto(),
  'pronombre' => $producto->getProNombre(),
  'prodetalle' => str_replace("'", "''", $producto->getProDetalle()),
  'procantstock' => $producto->getProCantStock(),
  'proprecio' => $producto->getProPrecio(),
  'propreciooferta' => ($producto->getProPrecioOferta() == null) ? null : $producto->getProPrecioOferta(),
  'prodeshabilitado' => ($producto->getProDeshabilitado() == null) ? fecha() : null
];

$abmProducto->modificacion($datos);

header("Status: 301 Moved Permanently");
if (isset($data['v'])) {
  header("Location: estadoProducto.php");
} else {
  header("Location: {$INICIO}");
}
