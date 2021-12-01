<?php

class ListarUsuariosControl {
  function listar() {
    $objAbmUsuario = new AbmUsuario();
    $listaUsuarios = $objAbmUsuario->buscar(null);

    return $listaUsuarios;
  }

  function printRoles($objUsuario) {
    $textoRoles = '';
    $roles = $objUsuario->getColRoles();
    sort($roles);
    $last_key = array_key_last($roles);
    foreach ($roles as $key => $rol) {
      $textoRoles .= $rol->getRoDescripcion();
      if ($key != $last_key) {
        $textoRoles .= " - ";
      }
    }
    return $textoRoles;
  }

  function altaBajaUsuario() {
    $data = data_submitted();
    if (isset($data['idu']) and isset($data['baja'])) {
      $baja = $data['baja'];

      $abmUsuario = new AbmUsuario();
      $condicionUsuario['idusuario'] = $data['idu'];
      $usuario  = $abmUsuario->buscar($condicionUsuario)[0];

      $datosUsuario = [
        'idusuario' => $usuario->getIdUsuario(),
        'usnombre' => $usuario->getUsNombre(),
        'uspass' => $usuario->getUsPass(),
        'usmail' => $usuario->getUsMail(),
        'usdeshabilitado' => $baja == (1) ? fecha() : null
      ];

      $abmUsuario->modificacion($datosUsuario);
    }
  }

  function esRol() {
    $esRol['administrador'] = false;
    $esRol['usuario'] = false;

    if (isset($_SESSION['idusuario'])) {

      $abmUsuario = new AbmUsuario();
      $condicionUsuario['idusuario'] = $_SESSION['idusuario'];
      $usuario  = $abmUsuario->buscar($condicionUsuario)[0];

      $rolesUsuarioLog = $usuario->getColRoles();

      foreach ($rolesUsuarioLog as $rol) {
        if ($rol->getIdRol() == 1) {
          $esRol['administrador'] = true;
        }
        if ($rol->getIdRol() == 2) {
          $esRol['deposito'] = true;
        }
        if ($rol->getIdRol() == 3) {
          $esRol['cliente'] = true;
        }
      }
    }

    return $esRol;
  }
}
