<?php $title = 'Mi Carrito';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php


if (!isset($_SESSION["idusuario"])) {
  header('Location: http://localhost/PWD_TPFinal/View/paginaSegura.php');
}

if (!isset($_SESSION["carrito"])) {
  $_SESSION["carrito"] = [];
}

if (isset(data_submitted()["idproducto"])) {

  $control = new CarritoControl();
  $param["idProducto"] = data_submitted()["idproducto"];
  $resp = $control->agregarProducto($param);
}

?>


<div class="container border mt-5">

  <div class="m-3">
    <?php if (isset($_SESSION["carrito"])) { ?>
      <p class="fs-3 mt-3">Carrito (<?= count($_SESSION["carrito"]) ?> productos)</p>

      <?php }
    if (isset($_SESSION["carrito"])) {
      $controlProducto = new AbmProducto();
      $precioTotal = 0;
      foreach ($_SESSION["carrito"] as $arrProducto) {
        $param["idproducto"] = $arrProducto["idProducto"];
        $producto = $controlProducto->buscar($param);
        $detallesProAct = json_decode($producto[0]->getProDetalle(), true);
        $dirImgAct = md5($producto[0]->getIdProducto());
        $arrImagenesAct = scandir($ROOT . "view/img/Productos/" . $dirImgAct);
        if ($producto[0]->getProPrecioOferta() != null) {
          $precioTotal += $producto[0]->getProPrecioOferta() * $arrProducto["cantidadProducto"];
        } else {
          $precioTotal += $producto[0]->getProPrecio() * $arrProducto["cantidadProducto"];
        }

      ?>
        <div class="compra d-flex justify-content-between mt-5">
          <!-- INFORMACION GENERAL DEL PRODUCTO -->
          <div class="d-flex">
            <img src="./img/Productos/<?= $dirImgAct . '/' . $arrImagenesAct[2] ?>" alt="" style="height: 100px;">

            <div class="d-flex flex-column">
              <p class="fw-bold mb-0"></p>
              <p class="text mb-0"><?= $producto[0]->getProNombre() ?></p>
              <p class="text-success">Envio Gratis</p>
              <a href="../Controller/eliminarProdCarrito.php?id=<?= $producto[0]->getIdProducto(); ?>" class="mt-2">Eliminar</a>
            </div>
          </div>
          <!-- INPUT, CAMBIAR CANTIDAD -->
          <div>
            <form class="needs-validation" novalidate action="../Controller/cambiarCantidad.php">
              <div class="formCantidad2 mb-3">
                <!-- ID PRODUCTO OCULTO -->
                <input name="idProd" type="number" class="form-control" style="display: none;" placeholder="<?= $producto[0]->getIdProducto(); ?>" value=<?= $producto[0]->getIdProducto(); ?>>

                <!-- CANTIDAD -->
                <div id="padreInput">
                  <input name="cantidadProd" type="number" class="form-control inputCantidad" id="cantidadProducto" placeholder="Cantidad: <?= $arrProducto["cantidadProducto"] ?>" min="1" max="<?= $producto[0]->getProCantStock(); ?>" value=<?= $arrProducto["cantidadProducto"] ?>>
                  <div class="invalid-feedback">No hay stock suficiente.</div>
                </div>

              </div>
              <button id="botonCambiar" type="submit" class="disabled btn btn-primary botonCambiar">Cambiar Cantidad</button>
            </form>

          </div>

          <!-- PRECIO -->
          <div class="precio">
            <p class="fw-bold">$<?php
                                if ($producto[0]->getProPrecioOferta() == null) {
                                  echo $producto[0]->getProPrecio() * intval($arrProducto["cantidadProducto"]);
                                } else {
                                  echo $producto[0]->getProPrecioOferta() * intval($arrProducto["cantidadProducto"]);
                                }
                                ?></p>
          </div>
        </div>
      <?php
      }
    }
    /* PRECIO TOTAL */
    if (count($_SESSION["carrito"]) > 0) {
      echo "<div class='ms-2 mt-3 fs-5'>Precio total:  \${$precioTotal}</div>";
    }

    /* NOTIFICACION DE QUE EL PRODUCTO YA SE ENCUENTRA EN EL CARRITO  */
    if (isset($resp) && $resp) { ?>

      <div id="toastNotif" class="toast fixedToast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true" style="display: block;">
        <div class="d-flex">
          <div class="toast-body fs-6">
            El producto <?= $producto[0]->getProNombre() ?> ya se encuentra en el carrito
          </div>
          <button id="toastNotifClose" type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>

    <?php } ?>

  </div>

</div>
<div class="container  ">
  <a href="../Controller/confirmarCompra.php" class="btn <?php if (count($_SESSION["carrito"]) < 1) { ?> disabled <?php } ?> btn-primary" type="submit">Comprar</a>
  <a href="comprar.php" class="btn btn-success" type=""><i class="fas fa-undo-alt"> Seguir comprando</i></a>
</div>



<?php include_once './includes/footer.php' ?>
<script defer src="./js/cambiarCantidad.js"></script>
<script defer src="./js/validation.js"></script>