<?php

class Producto {

  private $idproducto;
  private $pronombre;
  private $prodetalle;
  private $procantstock;
  private $proprecio;
  private $propreciooferta;
  private $prodeshabilitado;
  private $msjerror;

  public function __construct() {
    $this->idproducto = null;
    $this->pronombre = '';
    $this->prodetalle = '';
    $this->procantstock = null;
    $this->proprecio = null;
    $this->propreciooferta = null;
    $this->prodeshabilitado = null;
  }

  public function setear($idproducto, $pronombre, $prodetalle, $procantstock, $proprecio, $propreciooferta, $prodeshabilitado) {
    $this->setIdProducto($idproducto);
    $this->setPronombre($pronombre);
    $this->setProDetalle($prodetalle);
    $this->setProCantStock($procantstock);
    $this->setProPrecio($proprecio);
    $this->setProPrecioOferta($propreciooferta);
    $this->setProDeshabilitado($prodeshabilitado);
  }

  public function getIdProducto() {
    return $this->idproducto;
  }
  public function setIdProducto($idproducto) {
    $this->idproducto = $idproducto;
  }

  public function getProNombre() {
    return $this->pronombre;
  }
  public function setProNombre($pronombre) {
    $this->pronombre = $pronombre;
  }

  public function getProDetalle() {
    return $this->prodetalle;
  }
  public function setProDetalle($prodetalle) {
    $this->prodetalle = $prodetalle;
  }

  public function getProCantStock() {
    return $this->procantstock;
  }
  public function setProCantStock($procantstock) {
    $this->procantstock = $procantstock;
  }

  public function getProPrecio() {
    return $this->proprecio;
  }
  public function setProPrecio($proprecio) {
    $this->proprecio = $proprecio;
  }

  public function getProPrecioOferta() {
    return $this->propreciooferta;
  }
  public function setProPrecioOferta($propreciooferta) {
    $this->propreciooferta = $propreciooferta;
  }

  public function getProDeshabilitado() {
    return $this->prodeshabilitado;
  }
  public function setProDeshabilitado($prodeshabilitado) {
    $this->prodeshabilitado = $prodeshabilitado;
  }

  public function getMsjError() {
    return $this->msjerror;
  }
  public function setMsjError($msjerror) {
    $this->msjerror = $msjerror;
  }

  public function cargar() {
    $resp = false;
    $base = new DataBase();
    $sql = "SELECT * FROM producto WHERE idproducto = {$this->getIdProducto()}";
    if ($base->Iniciar()) {
      $res = $base->Ejecutar($sql);
      if ($res > -1) {
        if ($res > 0) {
          $row = $base->Registro();
          $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proprecio'], $row['propreciooferta'], $row['prodeshabilitado']);
        }
      }
    } else {
      $this->setMsjError("Tabla->listar: {$base->getError()}");
    }
    return $resp;
  }

  public function insertar() {
    $resp = false;
    $base = new DataBase();
    $sql = "
    INSERT INTO producto (pronombre, prodetalle, procantstock, proprecio, propreciooferta, prodeshabilitado) 
    VALUES ('{$this->getProNombre()}', '{$this->getProDetalle()}', {$this->getProCantStock()}, {$this->getProPrecio()}," . (($this->getProPrecioOferta() == NULL) ? 'NULL' : "{$this->getProPrecioOferta()}") . ", " . (($this->getProDeshabilitado() == NULL) ? 'NULL' : "'{$this->getProDeshabilitado()}'") . ")";

    if ($base->Iniciar()) {
      if ($id = $base->Ejecutar($sql)) {
        $this->setIdProducto($id);

        $resp = true;
      } else {
        $this->setMsjError("Tabla->insertar: {$base->getError()[2]}");
      }
    } else {
      $this->setMsjError("Tabla->insertar: {$base->getError()[2]}");
    }
    return $resp;
  }

  public function modificar() {
    $resp = false;
    $base = new DataBase();
    $sql = "UPDATE producto SET
      pronombre = '{$this->getProNombre()}',
      prodetalle = '" . str_replace("'", "", $this->getProDetalle()) . "',
      procantstock = {$this->getProCantStock()},
      proprecio = {$this->getProPrecio()},
      propreciooferta = " . (($this->getProPrecioOferta() == NULL) ? 'NULL' : "{$this->getProPrecioOferta()}") . ",
      prodeshabilitado = " . (($this->getProDeshabilitado() == NULL) ? 'NULL' : "'{$this->getProDeshabilitado()}'") . "
      WHERE idproducto = {$this->getIdProducto()}";
    	// echo $sql;
    if ($base->Iniciar()) {
      if ($base->Ejecutar($sql)>-1) { // Modificar si hace falta o cambiar el modifcar producto
        $resp = true;
      } else {
        $this->setMsjError("Tabla->modificar: {$base->getError()}");
      }
    } else {
      $this->setMsjError("Tabla->modificar: {$base->getError()}");
    }
    return $resp;
  }

  public function eliminar() {
    $resp = false;
    $base = new DataBase();
    $sql = "DELETE FROM producto WHERE idproducto= {$this->getIdProducto()}";
    if ($base->Iniciar()) {
      if ($base->Ejecutar($sql)) {
        return true;
      } else {
        $this->setMsjError("Tabla->eliminar: {$base->getError()}");
      }
    } else {
      $this->setMsjError("Tabla->eliminar: {$base->getError()}");
    }
    return $resp;
  }

  public static function listar($parametro = "") {
    $arreglo = array();
    $base = new DataBase();
    $sql = "SELECT * FROM producto ";
    if ($parametro != "") {
      $sql .= " WHERE {$parametro}";
    }
    $res = $base->Ejecutar($sql);
    if ($res > -1) {
      if ($res > 0) {
        while ($row = $base->Registro()) {
          $obj = new Producto();

          $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proprecio'], $row['propreciooferta'], $row['prodeshabilitado']);

          array_push($arreglo, $obj);
        }
      }
    }

    return $arreglo;
  }
}
