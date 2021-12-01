<?php $title = 'Realizar Compra';
include_once './includes/head.php'; ?>



<?php
if (count($_SESSION["carrito"]) > 0) {
   $compraExitosa = false;
   // mostrarArray($_SESSION);
   $abmCompra = new AbmCompra();
   $param["idusuario"] = $_SESSION["idusuario"];
   $param["cofecha"] = date('Y-m-d H:i:s');
   $resp = $abmCompra->alta($param);

   $precioTotal = 0;

   if ($resp["exito"]) {
      $i = 0;
      $j = 0;
      $falloCompraItem = false;
      do {
         $producto = $_SESSION["carrito"][$i];
         // mostrarArray($producto);
         $abmProducto = new AbmProducto();
         $param["idproducto"] = $producto["idProducto"];
         $objProducto = $abmProducto->buscar($param);
         $precioTotal = $objProducto[0]->getProPrecio() * $producto["cantidadProducto"];

         $abmCompraItem = new AbmCompraItem();

         $datosCompraItem["idproducto"] = $producto["idProducto"];
         $datosCompraItem["cicantidad"] = $producto["cantidadProducto"];
         $datosCompraItem["idcompra"] = $resp["idcompra"];
         $datosCompraItem["cipreciototal"] = $precioTotal;

         if ($abmCompraItem->alta($datosCompraItem)) {
            // echo "<div class='ms-2 mt-3 fs-5'>Compra realizada correctamente</div>";
            $cantActual = $objProducto[0]->getProCantStock();
            $nuevaCant = $cantActual - $datosCompraItem["cicantidad"];
            $objProducto[0]->setProCantStock($nuevaCant);
            // echo $cantActual;
            // echo $nuevaCant;
            
            // echo $cambioStock;
            // echo $objProducto[0]->getProCantStock();
            $datosMod = [
               'idproducto' => $objProducto[0]->getIdProducto(),
               'pronombre' => $objProducto[0]->getProNombre(),
               'prodetalle' => str_replace("'", "''", $objProducto[0]->getProDetalle()),
               'procantstock' => $objProducto[0]->getProCantStock(),
               'proprecio' => $objProducto[0]->getProPrecio(),
               'propreciooferta' => ($objProducto[0]->getProPrecioOferta() == null) ? "null" : $objProducto[0]->getProPrecioOferta(),
               'prodeshabilitado' => $objProducto[0]->getProDeshabilitado(),
            ];
            // mostrarArray($datosMod);
            $abmProducto->modificacion($datosMod);

            $j++;
         } else $falloCompraItem = true;
         $i++;
      } while ($i < count($_SESSION["carrito"]) && $falloCompraItem == false);
      if ($j == $i) {
         $datosCompraEstado = [
            "idcompra" => $resp["idcompra"],
            "idcompraestadotipo" => 1,
            "cefechaini" => date('Y-m-d H:i:s'),
            "cefechafin" => "null",
         ];
         // mostrarArray($datosCompraEstado);
         $abmCompraEstado = new AbmCompraEstado();
         $altaCompraEstado =  $abmCompraEstado->alta($datosCompraEstado);
         $_SESSION["carrito"] = [];
         $compraExitosa = true;
      } else if ($j < $i || $altaCompraEstado == false) {
         $arrCompraItems = $abmCompraItem->buscar($resp["idcompra"]);
         foreach ($arrCompraItems as $compraItem) {
            $compraItem->baja(["idcompraitem" => $compraItem->getIdCompraItem()]);
         }
         $compraExitosa = false;
      }
   } else $compraExitosa = false;
} else $compraExitosa = false;
header('Location: estadoDeCompra.php?compraexitosa='.$compraExitosa);

?>