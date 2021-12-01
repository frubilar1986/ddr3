<?php

class AbmUsuario {

  /**
   * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
   * @param array $datos
   * @return Usuario
   */
  private function cargarObjeto($datos) {
    $obj = null;

    if (
      array_key_exists('idusuario', $datos) &&
      array_key_exists('usnombre', $datos) &&
      array_key_exists('uspass', $datos) &&
      array_key_exists('usmail', $datos) &&
      array_key_exists('usdeshabilitado', $datos)
    ) {
      $obj = new Usuario();

      $obj->setear($datos['idusuario'], $datos['usnombre'], $datos['uspass'], $datos['usmail'], $datos['usdeshabilitado']);
    }
    return $obj;
  }

  /**
   * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
   * @param array $datos
   * @return Usuario
   */
  private function cargarObjetoConClave($datos) {
    $obj = null;

    if (isset($datos['idusuario'])) {
      $obj = new Usuario();
      //$obj->setear($datos['idusuario'], null, null, null, null);
      $obj->setear($datos['idusuario'], "", "", "", null);
    }
    return $obj;
  }


  /**
   * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
   * @param array $datos
   * @return boolean
   */

  private function seteadosCamposClaves($datos) {
    $resp = false;
    if (isset($datos['idusuario']))
      $resp = true;
    return $resp;
  }

  /**
   * Permite ingresar un registro en la base de datos
   * @param array $datos
   * @return boolean
   */
  public function alta($datos) {
    $resp = false;
    $datos['idusuario'] = null;
    $datos['usdeshabilitado'] = null;
    $obj = $this->cargarObjeto($datos);

    if ($obj != null && $obj->insertar()) {
      $resp = true;
    }
    return $resp;
  }
  /**
   * permite eliminar un objeto 
   * @param array $datos
   * @return boolean
   */
  public function baja($datos) {
    $resp = false;
    if ($this->seteadosCamposClaves($datos)) {
      $obj = $this->cargarObjetoConClave($datos);
      if ($obj != null && $obj->eliminar()) {
        $resp = true;
      }
    }

    return $resp;
  }

  /**
   * permite modificar un objeto
   * @param array $datos
   * @return boolean
   */
  public function modificacion($datos) {
    $resp = false;
    if ($this->seteadosCamposClaves($datos)) {
      $obj = $this->cargarObjeto($datos);
      if ($obj != null && $obj->modificar()) {
        $resp = true;
      }
    }

    return $resp;
  }

  /**
   * permite buscar un objeto
   * @param array $datos
   * @return array
   */
  public function buscar($datos) {
    $where = " true ";
    if ($datos != null) {
      if (isset($datos['idusuario']))
        $where .= " and idusuario  = {$datos['idusuario']}";
      if (isset($datos['usnombre']))
        $where .= " and usnombre = '{$datos['usnombre']}'";
      if (isset($datos['uspass']))
        $where .= " and uspass = '{$datos['uspass']}'";
      if (isset($datos['usmail']))
        $where .= " and usmail = '{$datos['usmail']}'";
      if (isset($datos['usdeshabilitado']))
        $where .= " and usdeshabilitado = '{$datos['usdeshabilitado']}'";
    }

    $arreglo = Usuario::listar($where);
    return $arreglo;
  }
}
