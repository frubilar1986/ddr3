<?php
include_once "../config.php";

$control = new NavbarControl();
$urlActual = $control->urlActual();

if ($sesion->activa()) {
  $roles = $control->rolesUsuario($sesion);
  $rolActual = $control->rolActual($sesion);
  $menuRol = $control->menuRol($sesion);
  $menues = $control->menues($sesion);
  $subMenues = $control->subMenues($menues);
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand mx-5" href="<?= $INICIO ?>"><img src="./img/logo.png" alt="" style="width: 50px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Menues de usuarios -->
        <?php if ($sesion->activa()) { ?>
          <!-- Menu Rol -->
          <li class="nav-item dropdown">
            <?php if (isset($menues)) { ?>
              <a class="nav-link dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $menues[0]->getMeNombre() ?>
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php foreach ($subMenues as $menu) {
                  if (!$menu->getMeDeshabilitado()) {
                    echo "<li><a class='dropdown-item' href='" . strToCamelCase($menu->getMeNombre()) . ".php'>" . $menu->getMeNombre() . "</a></li>";
                  }
                } ?>
              </ul>
            <?php } ?>
          </li>

          <!-- Estado de Compra -->
          <li class=" nav-item">
            <a class="nav-link active" aria-current="page" href="./estadoCompra.php">Estado de Compra</a>
          </li>

          <!-- Lista de Usuarios -->
          <li class="nav-item">
            <!-- <a class="nav-link active" href="listarUsuario.php">Lista de Usuarios</a> -->
            <a class="nav-link active" href="editarDatosCliente.php">Editar mis datos</a>
          </li>
        <?php } ?>

        <!-- Celulares -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Celulares
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./celularesPag.php?marca=Motorola">Motorola</a></li>
            <li><a class="dropdown-item" href="./celularesPag.php?marca=Samsung">Samsung</a></li>
            <li><a class="dropdown-item" href="./celularesPag.php?marca=LG">LG</a></li>
            <li><a class="dropdown-item" href="./celularesPag.php?marca=TCL">TCL</a></li>
            <li><a class="dropdown-item" href="./celularesPag.php?marca=Nokia">Nokia</a></li>
          </ul>
        </li>

      </ul>
      <div class="text-danger h5">
        <?php if ($sesion->activa()) { ?>
          <?= $sesion->getObjUsuario()->getUsNombre() ?>
        <?php } ?>
      </div>
      &nbsp; &nbsp;
      <!-- Buscar -->
      <form action="./buscarAccion.php" class="d-flex">
        <input class="form-control" type="search" name="busqueda" placeholder="Buscar celular" aria-label="Search">
        <button class="btn border" type="submit"><i class="fas fa-search"></i></button>
      </form>

      <!-- Cambiar Roles -->
      <?php if (isset($roles) && count($roles) > 1) { ?>
        <div class="dropdown">
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <?= ($rolActual != null) ? $rolActual->getRoDescripcion() : "Roles"; ?>
          </a>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <?php foreach ($roles as $rol) { ?>
              <li><a class='dropdown-item' href='cambiarRol.php?idrol=<?= $rol->getIdRol() ?>&url=<?= $urlActual ?>'><?= $rol->getRoDescripcion() ?> </a></li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>

      <!-- Boton Login -->
      <div class="d-flex mx-5">
        <a class="boton-login nav-link" href="./carritoCompra.php"><i class="fas fa-shopping-cart"></i></a>

        <?php if ($sesion->activa()) { ?>
          <a class="btn btn-outline-primary" href="loginCerrar.php" role="button">Cerrar sesion</a>
        <?php } else { ?>
          <a class="btn btn-primary" href="login.php" role="button">Iniciar sesión</a>
        <?php } ?>
      </div>

    </div>
  </div>
</nav>