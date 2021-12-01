<?php include_once '../config.php' ?>

<?php $title = 'Busqueda';
include_once 'includes/head.php';
include_once 'includes/navbar.php';
$data = data_submitted();
    $accesoPag = new ctrolPagina;
    if(isset($data['idmenu'])){
        $_SESSION['idmenu'] = $data['idmenu'];
    }
    $access = $accesoPag->ctrl_acceso($_SESSION);

if ($access) {


  $ambProducto = new AbmProducto();

  $control = new NuevoProductoControl();
  $data = $control->procesarData();
  if ($data) {
    $exito = (isset($data['idproducto'])) ? $control->modificarProducto($data) : $control->agregarProducto($data);
  }
}
?>

<div class="container d-flex flex-column justify-content-center align-items-center text-center mt-20vh">

  <?php
  if ($access) {
    if ($exito === true) {
      $producto = $ambProducto->buscar(['pronombre' => $data['pronombre']])[0];
      $control->guardarImagenes($producto->getIdProducto());
  ?>
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading"><?= (isset($data['idproducto'])) ? "Se modifico el producto" : "Se agrego el producto"; ?></h4>
        <a class="btn btn-primary" href="./productoPag.php?id=<?= $producto->getIdProducto() ?>&nombrecel=<?= $producto->getProNombre() ?>" role="button">Ver Producto</a>
      </div>

    <?php } elseif ($exito !== false) { ?>
      <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading"><?= $exito ?></h4>
      </div>
    <?php } else { ?>
      <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">No se puedo agregar el producto, revisar los datos ingresados</h4>
      </div>
    <?php } ?>

    <div class="text-center mt-5">
      <a class='btn btn-primary' href="nuevoProducto.php" role='button'>Agregar otro producto</a>
    </div>

  <?php  } else { ?>
    <div class="alert alert-warning" role="alert">
      No tiene permiso para acceder <a href="<?= $INICIO ?>" class="alert-link">volver al inicio</a>.
    </div>
  <?php } ?>
</div>


<?php include_once "./includes/footer.php";
