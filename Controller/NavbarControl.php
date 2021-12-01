<?php

class NavbarControl {
  function urlActual() {
    $urlActual = $_SERVER['PHP_SELF'];
    $urlActual = explode('/', $urlActual);
    $urlActual = $urlActual[count($urlActual) - 1];

    return $urlActual;
  }

  function rolesUsuario($sesion) {
    return  $sesion->getObjUsuario()->getColRoles();
  }

  function rolActual($sesion) {
    $abmRol = new AbmRol();
    return $abmRol->buscar(['idrol' => $sesion->getRolActual()])[0];
  }

  function menuRol($sesion) {
    $abmMenuRol = new AbmMenuRol;
    return $abmMenuRol->buscar(['idrol' => $sesion->getRolActual()]);
  }

  function menues($sesion) {
    $abmMenu = new AbmMenu;
    return $abmMenu->buscar(['idmenu' => $sesion->getRolActual()]);
  }

  function subMenues($menues) {
    $abmMenu = new AbmMenu;
    return $abmMenu->buscar(['idpadre' => $menues[0]->getIdMenu()]);
  }
}
