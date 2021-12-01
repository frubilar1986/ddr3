<?php $title = 'Inicio';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$controlProducto = new AbmProducto();
$arrProductos = $controlProducto->buscar("");
$rolActual = $sesion->getRolActual();
$arrBanner = array_diff(scandir($ROOT . "View/img/Banner"), array('..', '.'));

?>

<?php if (count($arrBanner) > 0) { ?>
  <div id="banner" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
      <button type="button" data-bs-target="#banner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

      <?php for ($i = 1; $i < count($arrBanner); $i++) { ?>
        <button type="button" data-bs-target="#banner" data-bs-slide-to="<?= $i ?>" aria-label="Slide <?= $i + 1 ?>"></button>
      <?php } ?>
    </div>

    <div class="carousel-inner">

      <div class="carousel-item active">
        <img class="d-block w-100" src="../View/img/Banner/<?= $arrBanner[2] ?>" alt="">
        <?php unset($arrBanner[2]) ?>
      </div>

      <?php foreach ($arrBanner as $index => $banner) { ?>

        <div class="carousel-item">
          <img class="d-block w-100" src="../View/img/Banner/<?= $banner ?>" alt="">
        </div>

      <?php } ?>
    </div>

  </div>

<?php } ?>

<div class="container mb-5">
  <h2 class="mt-5">Tienda DDR</h2>
  <h4 class="">Somos una tienda online de venta de celulares, con grandes ofertas y descuentos.</h4>
  <p>Para contactarte con nosotros, podes hacerlo con nuestro email (tienda@ddr.com) o con nuestro telefono: +54 (299) 5748291</p>
</div>

<div id="filter-list" class="mt-3 w-100 d-flex align-items-center justify-content-center">
  <ul class="d-flex w-100 justify-content-center">
    <li class="list lindo-hover active" data-filter="todo">Todo</li>
    <li class="list lindo-hover" data-filter="Motorola">Motorola</li>
    <li class="list lindo-hover" data-filter="LG">LG</li>
    <li class="list lindo-hover" data-filter="TCL">TCL</li>
    <li class="list lindo-hover" data-filter="Nokia">Nokia</li>
    <li class="list lindo-hover" data-filter="Samsung">Samsung</li>
  </ul>
</div>

<div id="seccion-productos" class="container productos d-flex flex-wrap">

  <div class="container d-flex flex-wrap justify-content-center">
    <?php if ($rolActual == 2) { ?>
      <div class="sombra-caja border item-box m-5 d-flex flex-column align-items-center justify-content-center" style="min-width: 282px; min-height: 580px">
        <h5 class="mb-5">Agregar Celular</h5>
        <a href="./nuevoProducto.php">
          <i class="bi bi-plus-circle" style="font-size: 8rem;"></i>
        </a>
      <?php } ?>
      </div>
      <?php
      $arrProductos = ordenarArregloProductos($arrProductos);
      foreach ($arrProductos as $producto) {
        if (($rolActual == 2) || ($producto->getProDeshabilitado() == null && $rolActual != 2)) { // Si el rol es deposito muestro todos los celulartes, si es otro rol y no esta deshabilitado tambien muestra
          if (($producto->getProCantStock() >= 0)) {
            $detallesProAct = json_decode($producto->getProDetalle(), true);
            $dirImgAct = md5($producto->getIdProducto());
            $arrImagenesAct = scandir("{$ROOT}View/img/Productos/{$dirImgAct}");
      ?>
            <div data-item="<?= $detallesProAct["marca"] ?>" class="sombra-caja border item-box m-5 py-4 d-flex flex-column align-items-center justify-content-around" style="width: 282px; min-height: 560px">

              <?php if ($producto->getProDeshabilitado()) { ?>
                <div class="bg-danger mensaje-baja" style="height: 43px; width: 282px">
                  <p class="text-light text-center align-middle fs-3 ">DADO DE BAJA</p>
                </div>
              <?php } ?>

              <h3 class="p-3 text-center"><?= $producto->getProNombre() ?></h3>
              <a href="./productoPag.php?id=<?= $producto->getIdProducto() ?>&nombrecel=<?= $producto->getProNombre() ?>">

                <!-- <img  class="d-block w-100" alt=""> -->
                <img class=" <?= ($producto->getProDeshabilitado()) ? 'img-baja' : '' ?>" src="./img/Productos/<?= (count($arrImagenesAct) > 2) ? ($dirImgAct . '/' . $arrImagenesAct[2]) : ('producto-sin-imagen.png'); ?>" alt="" style="width: 250px;">

              </a>

              <?php if ($producto->getProCantStock() == 0) { ?>
                <p class='fw-bold text-danger'>Producto sin stock</span></p>
              <?php } else if ($producto->getProPrecioOferta() != null) { ?>

                <p class="text-nowrap">
                  <span class='text-muted text-decoration-line-through'>$<?= $producto->getProPrecio() ?></span>
                  <span class='fs-4'>$<?= $producto->getProPrecioOferta() ?></span>
                </p>

              <?php } else { ?>
                <p class='fs-4'>$<?= $producto->getProPrecio() ?> </p>
              <?php } ?>

              <?php if ($rolActual == 2) { ?>
                <div class="d-flex">
                  <a href="./nuevoProducto.php?id=<?= $producto->getIdProducto() ?>" class="btn btn-primary mx-1 mb-2">Editar</a>
                  <a href="./estadoProductoAccion.php?id=<?= $producto->getIdProducto() ?>" class=" btn btn-<?= ($producto->getProDeshabilitado()) ? 'success' : 'danger' ?> mx-1 mb-2"><?= ($producto->getProDeshabilitado()) ? 'Dar de alta' : 'Dar de baja'; ?></a>
                </div>
              <?php } ?>

            </div>
      <?php }
        }
      } ?>
  </div>

</div>

<?php include_once "./includes/footer.php"; ?>
<script src="./js/filtroProductos.js"></script>