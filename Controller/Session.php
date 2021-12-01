<?php
class Session {
  private $objUsuario;
  private $colRoles;
  private $rolActual;
  private $carrito;

  public function __construct() {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
      $this->objUsuario = null;
      $this->colRoles = null;
    }
  }

  public function iniciar($nombreUsuario, $psw) {
    $condiciones['usnombre'] = $nombreUsuario;
    $condiciones['uspass'] = $psw;

    $abmUsuario = new AbmUsuario();
    $colUsuarios = $abmUsuario->buscar($condiciones);

    if (count($colUsuarios) > 0 && $colUsuarios[0]->getUsDeshabilitado() == null) {
      $usuario = $colUsuarios[0];
      $this->setObjUsuario($usuario);
      $_SESSION['idusuario'] = $usuario->getIdUsuario();
    }
  }

  /**
   * @return Usuario
   */
  //si no hay usuario cargado 
  public function getObjUsuario() {
    if ($this->objUsuario == null && isset($_SESSION['idusuario'])) {
      $abmUsuario = new AbmUsuario();
      $condiciones['idusuario'] = $_SESSION['idusuario'];
      $usuario = $abmUsuario->buscar($condiciones);
      
      if (count($usuario) > 0) {
        $this->setObjUsuario($usuario[0]);
      }
  }

    return $this->objUsuario;
  }
  public function setObjUsuario($objUsuario) {
    $this->objUsuario = $objUsuario;
  }

/*   public function getCarrito(){
    if (isset($_SESSION['carrito'])) {
      $this->setCarrito($_SESSION['carrito']);
    }
    return $this->carrito;
  }

  public function setCarrito($carrito) {
    $this->carrito = $carrito;
  } */

  public function getColRoles() {
    if (!$this->colRoles) {
      $this->setColRoles($this->getObjUsuario()->getColRoles());
    }

    return $this->colRoles;
  }
  public function setColRoles($colRoles) {
    $this->colRoles = $colRoles;
  }
  
  public function getRolActual() {
    if (isset($_SESSION['rol'])) {
      $this->setRolActual($_SESSION['rol']);
    }
    return $this->rolActual;
  }
  public function setRolActual($rolActual) {
    $this->rolActual = $rolActual;
  }

  public function validar() {
    return ($this->getObjUsuario() != null) ? true : false;
  }

  static public function activa() {
    return (isset($_SESSION['idusuario'])) ? true : false;
  }

  public function cerrar() {
    if ($this->getObjUsuario()) {
      session_unset();
      session_destroy();
      $this->objUsuario = null;
      $this->colRoles = null;
    }
  }
}
