<?php include_once "../config.php" ?>

<?php $title = 'Modificar Productos';
include_once 'includes/head.php';
include_once 'includes/navbar.php';

$control = new ListarProductosControl();
$productos = $control->listar();

?>


<div class="container d-flex justify-content-center align-items-start text-center mt-5">

  <?php if ($sesion->activa() && $sesion->getRolActual() == 2) { ?>

    <?php if (count($productos) > 0) { ?>

      <table class="table caption-top">

        <caption>
          <h1 class="pb-3 text-primary text-center">Modificar Productos</h1>
        </caption>


        <thead>
          <tr>
            <th scope="col">Producto</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $productos = ordenarArregloProductos($productos);

          foreach ($productos as $producto) {
            if ($producto->getProDeshabilitado() == null) {
              if (isset(json_decode($producto->getProDetalle(), true)['marca'])) {
                $modelo = json_decode($producto->getProDetalle(), true)['marca'];
              } else $modelo = "";
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


                <td>
                  <a class="btn btn-primary mt-3" title="Editar" href="./nuevoProducto.php?id=<?= $producto->getIdProducto() ?>" role="button"><i class="bi bi-pencil-square"></i></a>
                </td>

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
      <h4 class="alert-heading">Esta pagina es solo para depositadores</h4>
    </div>
  <?php } ?>

</div>

<?php include_once 'includes/footer.php' ?>