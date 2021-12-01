<?php include_once "../config.php" ?>

<?php $title = 'Ver Autos';
include_once 'includes/head.php' ?>
<?php include_once 'includes/navbar.php' ?>

<?php if ($sesion->activa()) { ?>

  <div class="container d-flex justify-content-center align-items-start text-center mt-5">
    <div class="alert alert-success" role="alert">
      <h1>Inicio de sesion correcto</h1>
    </div>
  </div>

<?php } else { ?>
  <div class="container d-flex justify-content-center align-items-start text-center mt-5">
    <div class="alert alert-danger mt-20vh" role="alert">
      <h4 class="alert-heading">Esta pagina es solo para usuarios registrados</h4>
    </div>
  </div>
<?php } ?>


<script src="js/validation.js"></script>

<?php include_once 'includes/footer.php' ?>