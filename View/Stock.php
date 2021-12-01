<?php include_once "../config.php" ?>

<?php $title = 'Stock Productos';
include_once 'includes/head.php';
include_once 'includes/navbar.php';

$control = new ListarProductosControl();
$productos = $control->listar();
$accesoPag = new ctrolPagina;
$access = $accesoPag->ctrl_acceso();
?>


<div class="container d-flex justify-content-center align-items-start text-center mt-5">

  <?php //if ($sesion->activa() && $sesion->getRolActual() == 2) { ?>
    <?php if ($access) { ?>


    <?php if (count($productos) > 0) { ?>

      <table class="table caption-top">

        <caption>
          <h1 class="pb-3 text-primary text-center">Stock Productos</h1>
        </caption>


        <thead>
          <tr>
            <th scope="col">Producto</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Cantidad en stock</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $productos = ordenarArregloProductos($productos);

          foreach ($productos as $producto) {
            if ($producto->getProDeshabilitado() == null) {
              $modelo = json_decode($producto->getProDetalle(), true)['marca'];
              $dirImg = md5($producto->getIdProducto());
              $img = scandir($ROOT . "view/img/Productos/" . $dirImg)[2];

          ?>

              <tr>

                <td>
                  <img style="max-height:70px" src="<?= "./img/Productos/{$dirImg}/{$img}" ?>">
                </td>
                <td>
                  <p class="mt-4"><?= $modelo ?></p>
                </td>
                <td>
                  <p class="mt-4"><?= $producto->getProNombre() ?></p>
                </td>

                <form action="../Controller/stockAccion.php?id=<?= $producto->getIdProducto() ?>">

                  <td>
                    <div class="d-flex justify-content-center">
                      <div class="input-group w-25 mb-3">
                        <input type="hidden" value="<?= $producto->getIdProducto() ?>" name="idproducto">
                        <input type="number" class="form-control mt-3 inputCantidad" value="<?= $producto->getProCantStock() ?>" min=0 name="procantstock" required>
                      </div>
                    </div>
                  </td>


                  <td>
                    <button type="submit" class="btn btn-primary mt-3 botonCambiar disabled" title="Actualizar cantidad"><i class="bi bi-arrow-up"></i></button>
                  </td>
                </form>


              </tr>


          <?php }
          } ?>
        </tbody>
      </table>

    <?php } else { ?>
      <div class="alert alert-danger d-flex align-items-center p-4" role="alert">
        <div>
          <h2>No hay usuarios cargados en el sistema</h2>
        </div>
      </div>
    <?php } ?>

  <?php } else { ?>
    <div class="alert alert-danger mt-20vh" role="alert">
      <h4 class="alert-heading">Esta pagina es solo para usuarios depositadores</h4>
    </div>
  <?php } ?>

</div>



<?php include_once 'includes/footer.php' ?>

<script defer src="./js/cambiarCantidad.js"></script>
