<?php
class NuevoProductoControl {

  function procesarData() {
    $data = data_submitted();

    if (isset($data['prodetalleC']) && isset($data['prodetalleD'])) {
      $data['prodetalle2'] = array_combine($data['prodetalleC'], $data['prodetalleD']);
      unset($data['prodetalleC']);
      unset($data['prodetalleD']);
      $data['prodetalle'] = array_merge($data['prodetalle'], $data['prodetalle2']);
      unset($data['prodetalle2']);
    }

    if (isset($data['prodetalle'])) {
      $data['prodetalle'] = json_encode($data['prodetalle']);
    }

    return $data;
  }

  function modificarProducto($data) {
    $ambProducto = new AbmProducto();
    if ($ambProducto->buscar(['idproducto' => $data['idproducto']])) {
      $data['prodeshabilitado'] = null;
      $exito = $ambProducto->modificacion($data);
    } else {
      $exito = 'Este producto no existe';
    }
    return $exito;
  }

  function agregarProducto($data) {
    $ambProducto = new AbmProducto();
    if (!$ambProducto->buscar(['pronombre' => $data['pronombre']])) {
      $data['prodeshabilitado'] = null;
      $exito = $ambProducto->alta($data);
    } else {
      $exito = 'Ya existe un producto con este nombre';
    }
    return $exito;
  }

  function guardarImagenes($idPro) {
    if ($_FILES['imagen']['name'][0] != '') {

      $dir = '../View/img/Productos/' . md5($idPro) . '/'; // carpeta para guardar imagen

      if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
      }

      $i = 0;
      while ($i < count($_FILES['imagen']['name'])) {
        if ($_FILES['imagen']['error'][$i] <= 0) {
          if (!copy($_FILES['imagen']['tmp_name'][$i], $dir . $_FILES['imagen']['name'][$i])) {
            echo "ERROR: no se pudo cargar la imagen";
          }
        } else {
          echo "ERROR: no se pudo cargar La imagen. No se pudo acceder al imagen temporal";
        }
        $i++;
      }
    }
  }
}
