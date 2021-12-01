<?php if (isset($_GET["marca"])) { $title = "Celulares {$_GET["marca"]}";} else $title = "Celulares";
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>

<?php
$controlProducto = new AbmProducto();
$arrProductos = $controlProducto->buscar("");
// mostrarArray($arrProductos);
?>
<?php
$data = data_submitted();
// mostrarArray($data);
if (array_key_exists("marca", $data)) {


?>

  <div id="seccion-productos" class="container productos d-flex ">
    <div class="container d-flex flex-wrap justify-content-center">
      <?php
      foreach ($arrProductos as $producto) {
        if ($producto->getProCantStock() > 0) {
          $detallesProAct = json_decode($producto->getProDetalle(), true);
          $marca = $_GET["marca"];

          if (isset($detallesProAct["marca"]) && $detallesProAct["marca"] == $marca) {


            $dirImgAct = md5($producto->getIdProducto());
            $arrImagenesAct = scandir($ROOT . "view/img/Productos/" . $dirImgAct);

      ?>
            <div data-item="<?= $detallesProAct["marca"] ?>" class="sombra-caja border item-box m-5 d-flex flex-column align-items-center justify-content-around" style="width: 282px; height: 559px">
              <h5><?= $producto->getProNombre() ?></h5>
              <a href="./productoPag.php?id=<?= $producto->getIdProducto() ?>&nombrecel=<?= $producto->getProNombre() ?>">
                <img src="./img/Productos/<?= $dirImgAct . '/' . $arrImagenesAct[2] ?>" alt="" style="width: 250px;">
              </a>
              <h5>$<?= $producto->getProPrecio() ?></h5>
            </div>
      <?php }
        }
      } ?>
    </div>
  </div>

<?php } else { ?>
  <div class="container d-flex justify-content-center align-items-start text-center mt-5">
    <div class="alert alert-warning mt-20vh" role="alert">
      <h4 class="alert-heading">No hay celulares de esta marca</h4>
    </div>
  </div>
<?php } ?>
<?php include_once "./includes/footer.php"; ?>
<script src="./js/filtroCursos.js"></script>