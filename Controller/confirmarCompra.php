<?php include_once '../View/includes/head.php'; ?>
<?php
$carrito = $_SESSION['carrito'];
if (count($carrito) > 0) {
   $compraExitosa = false;
   $abmCompra = new AbmCompra();
   $param["idusuario"] = $_SESSION["idusuario"];
   $param["cofecha"] = date('Y-m-d H:i:s');
   $resp = $abmCompra->alta($param);

   $precioTotal = 0;
   /* Si se da de alta la compra */
   if ($resp["exito"]) {
      $i = 0;
      $j = 0;
      $falloCompraItem = false;
      /* Ciclo el carrito y voy a crear un compra item por cada producto */
      do {
         $producto = $carrito[$i];
         $abmProducto = new AbmProducto();
         $param["idproducto"] = $producto["idProducto"];
         $objProducto = $abmProducto->buscar($param);
         $precioTotal = $objProducto[0]->getProPrecio() * $producto["cantidadProducto"];

         $abmCompraItem = new AbmCompraItem();

         $datosCompraItem["idproducto"] = $producto["idProducto"];
         $datosCompraItem["cicantidad"] = $producto["cantidadProducto"];
         $datosCompraItem["idcompra"] = $resp["idcompra"];
         $datosCompraItem["cipreciototal"] = $precioTotal;
         /* Si se da de alta el compra item, voy a modificar el stock del producto y modificarlo en la bd */
         if ($abmCompraItem->alta($datosCompraItem)) {
            $cantActual = $objProducto[0]->getProCantStock();
            $nuevaCant = $cantActual - $datosCompraItem["cicantidad"];
            $objProducto[0]->setProCantStock($nuevaCant);

            $datosMod = [
               'idproducto' => $objProducto[0]->getIdProducto(),
               'pronombre' => $objProducto[0]->getProNombre(),
               'prodetalle' => str_replace("'", "", $objProducto[0]->getProDetalle()),
               'procantstock' => $objProducto[0]->getProCantStock(),
               'proprecio' => $objProducto[0]->getProPrecio(),
               'propreciooferta' => ($objProducto[0]->getProPrecioOferta() == null) ? "null" : $objProducto[0]->getProPrecioOferta(),
               'prodeshabilitado' => $objProducto[0]->getProDeshabilitado(),
            ];
            $abmProducto->modificacion($datosMod);

            $j++;
         } else $falloCompraItem = true;
         $i++;
      } while ($i < count($carrito) && $falloCompraItem == false);
      /* Si la cantidad de productos modificados fue igual a la cantidad de productos en el carrito, creo el estado de la compra */
      if ($j == $i) {
         $datosCompraEstado = [
            "idcompra" => $resp["idcompra"],
            "idcompraestadotipo" => 1,
            "cefechaini" => date('Y-m-d H:i:s'),
            "cefechafin" => "null",
         ];
         $abmCompraEstado = new AbmCompraEstado();
         $altaCompraEstado =  $abmCompraEstado->alta($datosCompraEstado);
         /* Vacio el carrito */
         $_SESSION["carrito"] = [];
         $compraExitosa = true;
      /* Si no es igual la cantidad, voy a buscar cada compra item y lo voy a dar de baja */
      /* Faltaria dar de baja la compra tambien? */
      } else if ($j < $i || $altaCompraEstado == false) {
         $arrCompraItems = $abmCompraItem->buscar($resp["idcompra"]);
         foreach ($arrCompraItems as $compraItem) {
            $compraItem->baja(["idcompraitem" => $compraItem->getIdCompraItem()]);
         }
         $compraExitosa = false;
      }
   } else $compraExitosa = false;
} else $compraExitosa = false;
header('Location: ../View/estadoDeCompra.php?compraexitosa='.$compraExitosa);

?>