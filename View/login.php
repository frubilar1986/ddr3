<?php include_once "../config.php" ?>

<?php $title = 'Login';
include_once 'includes/head.php' ?>
<?php include_once 'includes/navbar.php' ?>

<div class="container d-flex justify-content-center align-items-start text-center mt-20vh">
  <div class="text-center mx-auto" style="max-width:300px">

    <img class="mb-4" src="img\logo.png" alt="logo" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>

    <form class="needs-validation" data-toggle="loginValidator" id="form-login" novalidate action="../Controller/loginAccion.php" method="post">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user p-1"></i></span>
          </div>
          <input type="text" name="usnombre" id="usnombre" placeholder="Username" class="form-control" required>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group mt-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock p-1"></i></span>
          </div>
          <input type="password" name="uspass" id="uspass" placeholder="Password" class="form-control" required>
        </div>
      </div>


      <button class="btn btn-primary btn-block mt-4" type="submit">Iniciar sesión</button>

    </form>
  </div>

</div>

<?php
if (array_key_exists("error", $_GET) && $_GET["error"] == 1) {
  echo "<div class='alert alert-danger w-25 mx-auto d-flex justify-content-center align-items-center  mt-5' role='alert'>
        Usuario y/o contraseña incorrectos.
      </div>";
} ?>
<?php
if (array_key_exists("error", $_GET) && $_GET["error"] == 2) {
  echo "<div class='alert alert-danger w-25 mx-auto d-flex justify-content-center align-items-center  mt-5' role='alert'>
        El usuario se encuentra dado de baja.
      </div>";
} ?>
<?php
if (array_key_exists("error", $_GET) && $_GET["error"] == 3) {
  echo "<div class='alert alert-danger w-25 mx-auto d-flex justify-content-center align-items-center  mt-5' role='alert'>
        Usuario no tiene rol asignado.
      </div>";
} ?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="./js/loginValidator.js"></script>

<?php include_once 'includes/footer.php' ?>