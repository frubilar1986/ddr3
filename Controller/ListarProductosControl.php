<?php

class ListarProductosControl {

  function listar() {
    $abmProducto = new AbmProducto();
    return $abmProducto->buscar(null);
  }
}
