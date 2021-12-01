<?php
include_once '../config.php';

$data = data_submitted();

if (array_key_exists("nombrecel", $data)) {
  $title =  $data["nombrecel"];
} else $title = "Celular";
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$controlProducto = new AbmProducto();


if (array_key_exists("id", $data) && $data["id"] != null) {
  $param["idproducto"] = $data["id"];
  $producto = $controlProducto->buscar($param);

  $detallesPro = json_decode($producto[0]->getProDetalle(), true);
  $dirImg = md5($data["id"]);
  $arrImagenes = scandir($ROOT . "View/img/Productos/" . $dirImg);
?>

  <div id="contenido-principal" class="container mt-5 d-flex border">
    <div class="w-100 m-3">
      <div id="producto" class="w-75 me-5">
        <p>Celulares <?= $detallesPro["marca"]; ?> <span class="text-black-50">/</span> <?= $producto[0]->getProNombre() ?> </p>
        <div class="d-flex w-100">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 250px; height: 366px">

            <div class="carousel-inner active">
              <!-- CARGO PRIMER IMAGEN "MANUALMENTE" PARA QUE TENGA LA CLASE ACTIVE -->
              <div class="carousel-item active">
                <!-- <img src="<?= $dirImg . '/' . $arrImagenes[2] ?>" class="d-block w-100" alt=""> -->
                <img src="./img/Productos/<?= (count($arrImagenes) > 2) ? ($dirImg . '/' . $arrImagenes[2]) : ('producto-sin-imagen.png'); ?>" class="d-block w-100" alt="">
              </div>
              <?php
              /* HAGO UN DO WHILE QUE RECORRA TODO EL DIR DE IMAGENES Y LAS USE TODAS */
              $i = 3;

              while ($i < count($arrImagenes)) {
              ?>
                <div class="carousel-item ">
                  <img src="./img/Productos/<?= $dirImg . '/' . $arrImagenes[$i] ?>" class="d-block w-100" alt="">
                </div>


              <?php
                $i++;
              }

              ?>
            </div>

            <div class="carousel-indicators m-0 mt-4 flex-wrap" style="position: relative; max-width: 245px">
              <?php
              $j = 2;

              while ($j < count($arrImagenes)) { ?>
                <img data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $j - 2 ?>" class="active border px-2" aria-current="true" aria-label="Slide <?= $j - 1 ?>" src="./img/Productos/<?= $dirImg . '/' . $arrImagenes[$j] ?>" alt="" style="width: 53px; height: 82px;">

              <?php $j++;
              } ?>

            </div>
          </div>
          <div id="informacion-producto" class="ms-5 d-flex flex-column w-100 justify-content-start align-items-start ">
            <div id="informacion" class="w-50">
              <h2 class="fs-1"><?= $producto[0]->getProNombre() ?></h2>
              <!-- PRECIO PRODUCTO -->
              <?php if ($producto[0]->getProPrecioOferta() != null) { ?>
                <p class='fs-5 text-muted mb-0 text-decoration-line-through'>$<?= $producto[0]->getProPrecio() ?></p>
                <p class='fs-3'>$<?= $producto[0]->getProPrecioOferta() ?></p>
              <?php } else { ?>
                <p class='fs-3'>$<?= $producto[0]->getProPrecio() ?></p>
              <?php } ?>
              <div class="d-flex">
                <p class="me-5 text-success text-nowrap"><i class="fas fa-check fa-xs text-success"></i> Envio Gratis</p>
                <!-- ¿HAY STOCK? -->
                <?php if ($producto[0]->getProCantStock() > 0) { ?>
                  <p class="text-success text-nowrap"><i class="fas fa-check fa-xs text-success"></i> Hay stock </p>
                <?php } else { ?>
                  <p class="text-danger text-nowrap"><i class="fas fa-times fa-xs text-danger"></i> No hay stock </p>
                <?php } ?>
              </div>
              <?php if ($producto[0]->getProCantStock() > 0) { ?>
                <form action="carritoCompra.php" method="POST">
                  <input type="number" class="hide" value="<?= $producto[0]->getIdProducto(); ?>" name="idproducto">
                  <button type="submit" <?php if (!isset($_SESSION["idusuario"])){ ?> disabled <?php } ?> class="btn btn-primary mt-4">Agregar al Carrito</button>
                </form>
              <?php } ?>
              <hr>
            </div>
            <div id="producto-descripcion" class="my-5 w-100">
              <div>
                <p class="uppercase">Descripción</p>
                <p><?= $detallesPro["desc1"]; ?></p>
                <p><?= $detallesPro["desc2"]; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container border" style="margin-top: 100px;">
        <div id="caracteristicas-tecnicas" class="m-3">
          <h4>Caracteristicas Técnicas</h4>
          <hr />
          <div class="d-flex">
            <div class="general d-flex flex-column justify-content-between" style="width: 40%;">
              <div id="camara-info" class="d-flex border align-items-center my-2">
                <img src="./img/camara.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Cámara Principal</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Camara Principal"]; ?></p>
                </div>
              </div>
              <div id="display-info" class="d-flex border align-items-center my-2">
                <img src="./img/display.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Display</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Display"]; ?></p>
                </div>
              </div>
              <div id="procesador-info" class="d-flex border align-items-center my-2">
                <img src="./img/procesador.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Procesador</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Procesador"]; ?></p>
                </div>
              </div>
              <div id="liberado-info" class="d-flex border align-items-center my-2">
                <img src="./img/liberado.png" alt="" class="fondo-desc-color p-2">
                <div class="ms-3">
                  <p class="m-0">Celular Liberado</p>
                  <p class="m-0 fw-bold"><?= $detallesPro["Celular Liberado"]; ?></p>
                </div>
              </div>
            </div>
            <div class="ms-5" style="width: 60%;">
              <ul class="d-flex flex-column" style="height: 70%;">
                <?php
                unset($detallesPro['desc1']);
                unset($detallesPro['desc2']);
                unset($detallesPro['marca']);
                unset($detallesPro['Camara Principal']);
                unset($detallesPro['Display']);
                unset($detallesPro['Procesador']);
                unset($detallesPro['Celular Liberado']);
                ?>
                <?php foreach ($detallesPro as $caracteristica => $detalle) { ?>
                  <li class="bullet fw-light"><?= $caracteristica ?>: <?= $detalle ?></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


<?php } else {
  echo "<p class='container fs-3 mt-5'>No se encontro el celular buscado.</p>";
} ?>

<?php include_once "./includes/footer.php"; ?>