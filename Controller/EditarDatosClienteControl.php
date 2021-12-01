<?php include_once "../config.php" ?>

<?php
class EditarDatosClienteControl
{
  function buscarUsuario()
  {
    $data = data_submitted();
    $usuario = null;

    if (isset($data['idu'])) {
      $controlAbmUsuario = new AbmUsuario();
      $condicion['idusuario'] = $data['idu'];

      if ($controlAbmUsuario->buscar($condicion)) {
        $usuario = $controlAbmUsuario->buscar($condicion)[0];
      }
    }

    return $usuario;
  }

  function rolesDisponibles()
  {
    $sesion = new Session();
    $controlRol = new AbmRol();
    $usuario = $sesion->getObjUsuario();
    $usuarioRoles = $usuario->getColRoles();

    $allRoles = $controlRol->buscar(null);
    // mostrarArray($allRoles);
    if ($usuarioRoles[0]->getIdRol() != 1) {
      unset($allRoles[0]);
    }


    return $allRoles;
  }

  private function modificarRoles($usuario, $idUsuario, $data, $exito)
  {
    $controlUsuarioRol = new AbmUsuarioRol();
    $rolesUsuario = $usuario->getColRoles();
    foreach ($rolesUsuario as $rolUsuario) {
      $baja = [
        'idusuario' => $idUsuario,
        'idrol' => $rolUsuario->getIdRol()
      ];
      $controlUsuarioRol->baja($baja);
    }

    if (isset($data['rol'])) {
      $rolesNuevos = $data['rol'];
      foreach ($rolesNuevos as $idRolNuevo => $nom) {
        $baja = ['idusuario' => $idUsuario, 'idrol' => $idRolNuevo];
        if (!$controlUsuarioRol->alta($baja)) {
          $exito['errorRol'] = "Hubo uno error al modificar el rol {$nom}";
        }
      }
    }
    return $exito;
  }

  private function modificarPass($usuario, $data, $exito)
  {
    if ($data['uspass'] != "null") {
      if ($data['uspass'] === $data['uspass2']) {
        $usuario->setUsPass(md5(intval($data['uspass'])));
      } else {
        $exito['errorPass'] = "Las contraseñas no coinciden, por lo tanto no se han cambiado";
      }
    }
    return $exito;
  }

  function modificar()
  {
    $exito = [];

    $data = data_submitted();

    $usuario = $this->buscarUsuario();

    if (isset($usuario) and isset($data['idu'])) {
      if ($data['idu'] == $usuario->getIdUsuario()) {
        $usuario->setUsNombre($data['usnombre']);
        $usuario->setUsMail($data['usmail']);

        $exito = $this->modificarPass($usuario, $data, $exito);
        $exito = $this->modificarRoles($usuario, $data['idu'], $data, $exito);

        $conAbmUsuario = new AbmUsuario();
        $datos = [
          'idusuario' => $usuario->getIdUsuario(),
          'usnombre' => $usuario->getUsNombre(),
          'uspass' => $usuario->getUsPass(),
          'usmail' => $usuario->getUsMail(),
          'usdeshabilitado' => $usuario->getUsDeshabilitado(),
        ];

        if (!$conAbmUsuario->modificacion($datos) and isset($exito['errorRol'])) {
          $exito['errorTotal'] = "No se pudo actualizar los datos";
        };
      } else {
        $exito['errorTotal'] = "Este usuario no se puede modificar";
      }
    }

    return $exito;
  }
}
