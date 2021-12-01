<?php include_once "../config.php" ?>

<?php
$control = new EditarDatosClienteControl();
$errores = $control->modificar();
?>

<?php $title = 'Actualizar Datos de Usuario';
include_once 'includes/head.php' ?>
<?php include_once 'includes/navbar.php' ?>


<div class="container text-center mt-20vh w-50">

  <?php if ($sesion->activa()) { ?>

    <?php if (isset($errores['errorTotal'])) { ?>

      <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading"><?= $errores['errorTotal'] ?></h4>
      </div>

    <?php } else { ?>

      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Modificacion correcta</h4>
        <p>Se modifico el usuario con los campos ingresados.</p>
        <?php
        if (count($errores) > 0) {
          echo "<hr>";
          foreach ($errores as $error) { ?>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
              <i class="fas fa-exclamation-triangle">&nbsp;&nbsp;</i>
              <div>
                <p class="mb-0"><?= $error ?></p>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>

    <?php } ?>

    <div class="text-center mt-5">
      <a class='btn btn-primary' href="usuarios.php" role='button'>Modificar otro usuario</a>
    </div>

  <?php } else { ?>
    <div class="alert alert-danger mt-20vh" role="alert">
      <h4 class="alert-heading">Esta pagina es solo para usuarios registrados</h4>
    </div>
  <?php } ?>

</div>


<?php include_once 'includes/footer.php' ?>