<?php
include_once "../config.php";

$control = new NavbarControl();
$urlActual = $control->urlActual();
mostrarArray($_SESSION);
$abmMr = new AbmMenuRol;
$col = $abmMr->buscar(["idrol"=>$_SESSION['rol']]);
mostrarArray($col);

if ($sesion->activa()) {
  $roles = $control->rolesUsuario($sesion);
  $rolActual = $control->rolActual($sesion);
  $menuRol = $control->menuRol($sesion);
  $menues = $control->menues($sesion);
  $subMenues = $control->subMenues($menues);
}
