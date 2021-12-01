<?php include_once '../config.php' ?>

<?php $title = (isset(data_submitted()['id'])) ? 'Modificar Producto' : 'Nuevo Producto';
include_once 'includes/head.php';
include_once 'includes/navbar.php';

$data = data_submitted();
if (isset($data['id'])) {
  $ambProducto = new AbmProducto();
  $producto = $ambProducto->buscar(['idproducto' => $data['id']]);
  $producto = (count($producto) > 0) ? $producto[0] : null;
  $proDetalles = json_decode($producto->getProDetalle(), true);
  $dirImg = md5($data["id"]);
  $arrImagenes = scandir($ROOT . "view/img/Productos/" . $dirImg);
}

?>


<div class="container d-flex justify-content-center align-items-start text-center mt-20vh">

  <?php if ($sesion->getRolActual() == 2) { ?>

    <form id="formulario-nuevo-producto" novalidate class="w-100 p-4 needs-validation" enctype="multipart/form-data" action="nuevoProductoAccion.php" method="post">

      <h1 class="pb-3 text-primary"><?= (isset($producto)) ? 'Editar Producto' : 'Nuevo Producto'; ?></h1>

      <?php if (isset($producto)) { ?>
        <input id="idproducto" name="idproducto" type="hidden" value="<?= $data['id'] ?>">
      <?php } ?>

      <div class="row g-4">
        <div class="col-md">
          <div class="form-floating mb-3">
            <input type="text" value="<?= (isset($producto)) ? $proDetalles['marca'] : null ?>" name="prodetalle[marca]" class="form-control" id="prodetalle[marca]" placeholder="Marca" required>
            <label for="prodetalle[marca]">Marca</label>
          </div>
        </div>

        <div class="col-md">
          <div class="form-floating mb-3">
            <input type="text" value="<?= (isset($producto)) ? $producto->getProNombre() : null ?>" name="pronombre" class="form-control" id="pronombre" placeholder="Modelo" required>
            <label for="pronombre">Modelo</label>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md">
          <div class="form-floating mb-3">
            <input type="number" value="<?= (isset($producto)) ? $producto->getProPrecio() : null ?>" name="proprecio" class="form-control" id="proprecio" min="0" placeholder="Precio" required>
            <label for="proprecio">Precio</label>
          </div>
        </div>

        <div class="col-md">
          <div class="form-floating mb-3">
            <input type="number" value="<?= (isset($producto)) ? $producto->getProPrecioOferta() : null ?>" name="propreciooferta" class="form-control" id="propreciooferta" min="0" placeholder="Precio Oferta">
            <label for="propreciooferta">Precio Oferta</label>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md">
          <div class="form-floating mb-3">
            <input type="number" value="<?= (isset($producto)) ? $producto->getProCantStock() : null ?>" name="procantstock" class="form-control" id="procantstock" min="0" placeholder="Cantidad Stock" required>
            <label for="procantstock">Cantidad Stock</label>
          </div>
        </div>
      </div>

      <div class="form-floating mb-3">
        <textarea class="form-control" name="prodetalle[desc1]" placeholder="Sinopsis" id="prodetalle[desc1]" style="height: 100px; resize: none;" required><?= (isset($producto)) ? $proDetalles['desc1'] : null ?></textarea>
        <label for="prodetalle[desc1]">Primer descripción</label>
      </div>

      <div class="form-floating mb-3">
        <textarea class="form-control" name="prodetalle[desc2]" placeholder="Sinopsis" id="prodetalle[desc2]" style="height: 100px; resize: none;" required><?= (isset($producto)) ? $proDetalles['desc2'] : null ?></textarea>
        <label for="prodetalle[desc2]">Segunda descripción</label>
      </div>


      <div class="form-group mb-3 mt-5">
        <label for="imagen" class="form-label">
          <h5>Imagenes del Producto</h5>
        </label>

        <input type="file" name="imagen[]" class="form-control" id="imagen" accept="image/*" multiple <?= (isset($producto) && count($arrImagenes) > 2) ? '' : 'required'; ?>>
        <small class="form-text text-muted pb-4">(maximo 20M)</small> <br>

        <?php if (isset($producto)) { ?>


          <div id="contenedor-imagenes">
            <?php foreach ($arrImagenes as $imagen) { ?>
              <?php if (strlen($imagen) > 2) { ?>

                <img class="img-thumbnail" style="max-height: 100px" src="img/Productos/<?= md5($producto->getIdProducto()) ?>/<?= $imagen ?>">

              <?php } ?>
            <?php } ?>

            <?php if (count($arrImagenes) > 2) { ?>
              <br>
              <a type="button" href="../Controller/borrarImagenes.php?id=<?=$producto->getIdProducto()?>" class="btn btn-labeled btn-danger mt-3" onclick="requerirImagen()" rel="nofollow" target="_blank">
                <span class="btn-label"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;Borrar imagenes</span>
              </a>
            <?php } ?>

          </div>


        <?php } ?>
      </div>


      <div class="form-group mt-5">
        <label for="imagen" class="form-label">
          <h5>Caracteristicas Técnicas</h5>
        </label>
        <input type="text" value="<?= (isset($producto)) ? $proDetalles['Camara Principal'] : null ?>" name="prodetalle[Camara Principal]" class="form-control mb-3" id="prodetalle[Camara Principal]" placeholder="Cámara Principal" required>
        <input type="text" value="<?= (isset($producto)) ? $proDetalles['Display'] : null ?>" name="prodetalle[Display]" class="form-control mb-3" id="display" placeholder="Display" required>
        <input type="text" value="<?= (isset($producto)) ? $proDetalles['Procesador'] : null ?>" name="prodetalle[Procesador]" class="form-control mb-3" id="procesador" placeholder="Procesador" required>
        <input type="text" value="<?= (isset($producto)) ? $proDetalles['Celular Liberado'] : null ?>" name="prodetalle[Celular Liberado]" class="form-control mb-3" id="liberado" placeholder="Liberado" required>
      </div>


      <div class="form-group mt-4" id="masCaracteristicas">
        <label for="imagen" class="form-label">
          <div class="d-flex">
            <h5 class="mt-2 mx-3">Mas Caracteristicas</h5>
            <button type="button" class="btn btn-outline-primary mb-3" onclick="agregarCaracteristica()">+</button>
          </div>
        </label>
        <?php
        if (isset($producto)) {
          unset($proDetalles['desc1']);
          unset($proDetalles['desc2']);
          unset($proDetalles['marca']);
          unset($proDetalles['Camara Principal']);
          unset($proDetalles['Display']);
          unset($proDetalles['Procesador']);
          unset($proDetalles['Celular Liberado']);
          foreach ($proDetalles as $caracteristica => $especificacion) { ?>

            <div class="input-group mb-3">
              <input type="text" name="prodetalleC[]" class="form-control" value="<?= $caracteristica ?>" placeholder="Caracteristica" aria-label="Username" required>
              <input type="text" name="prodetalleD[]" class="form-control" value="<?= $especificacion ?>" placeholder="Detalle" aria-label="Server" required>
            </div>

          <?php } ?>
        <?php } ?>
      </div>

      <div class="container d-flex justify-content-end">
        <button type="submit" class="btn btn-primary m-2">Enviar</button>
        <button type="reset" class="btn btn-danger m-2">Borrar</button>
      </div>
    </form>

  <?php } else { ?>
    <div class="alert alert-warning" role="alert">
      No tiene permiso para acceder <a href="<?= $INICIO ?>" class="alert-link">volver al inicio</a>.
    </div>
  <?php } ?>

</div>

<script>
  function requerirImagen() {
    let inputImagen = document.querySelectorAll("#imagen")[0];
    inputImagen.setAttribute("required", '');

    let imagenes = document.querySelectorAll("#contenedor-imagenes")[0];
    imagenes.classList.add("d-none");

  }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="js/addCaracteristica.js"></script>
<script src="js/validation.js"></script>

<?php include_once 'includes/footer.php' ?>