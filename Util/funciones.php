
<?php
/* Funcion que submite al arreglo get o post y lo coloca en un arreglo
asociativo; Util para que el proyecto no dependa de si es post o get */
function data_submitted() {
  $arreglo = array();
  if (!empty($_POST)) { //si No esta vacio en method post
    $arreglo = $_POST;
  } elseif (!empty($_GET)) {
    $arreglo = $_GET;
  }
  if (count($arreglo)) {
    // si existen campos vacios, carga null en el arreglo asoci
    foreach ($arreglo as $clave => $valor) {
      if ($valor == "") {
        $arreglo[$clave] = 'null';
      }
    }
  }
  return $arreglo;
}
/***
 * Establecer zona horaria argentina para carga en BD
 */
ini_set("date.timezone", "America/Argentina/Buenos_Aires");


/**
 * Funcion para mostrar de forma estructurada un arreglo 
 * @param array
 */
function mostrarArray($arreglo) {
  echo "<pre>";
  print_r($arreglo);
  echo "</pre>";
}

/* Funcion para poner a disponibilidad los objetos dentro del proyecto */

spl_autoload_register(function ($clase) {
  $directorios = array(
    $GLOBALS['ROOT'] . 'Model/connection/',
    $GLOBALS['ROOT'] . 'Model/',
    $GLOBALS['ROOT'] . 'Controller/',
  );



  foreach ($directorios as $directorio) {
    // echo "aqui se incluye" . $directorio . $clase . ".php<br>";

    if (file_exists($directorio . $clase . ".php")) {
      // echo "aqui se incluye" . $directorio . $clase . ".php";
      require_once($directorio . $clase . ".php");

      include_once($directorio . $clase . ".php");
      return;
    }
  }
});

function fecha($dias = 0) {
  date_default_timezone_set("America/Argentina/Buenos_Aires");
  $date = new DateTime('now');

  if ($dias != 0) {
    $date->modify('+' . $dias . ' day');
  }
  $date = $date->format('Y-m-d H:i:s');
  return $date;
}

//Ordenar arreglo
function opp2($a, $b) {
  return strcmp($a->getProDeshabilitado(), $b->getProDeshabilitado());
}

function opp($a, $b) {
  return strcmp($a->getProNombre(), $b->getProNombre());
}

function ordenarArregloProductos($array) {
  $proDes = [];
  $proHab = [];
  foreach ($array as $usuario) {
    if ($usuario->getProDeshabilitado()) {
      $proDes[] = $usuario;
    } else {
      $proHab[] = $usuario;
    }
  }

  if ($proHab) {
    usort($proHab, "opp");
  }

  if ($proDes) {
    usort($proDes, "opp");
  }

  $resultado = array_merge($proHab, $proDes);
  return $resultado;
}

//Ordenar arreglo
function cmp2($a, $b) {
  return strcmp($a->getUsDeshabilitado(), $b->getUsDeshabilitado());
}

function cmp($a, $b) {
  return strcmp($a->getUsNombre(), $b->getUsNombre());
}

function ordenarArregloUsuarios($array) {
  $usuariosDeshabilitados = [];
  $usuariosHabilitados = [];
  foreach ($array as $usuario) {
    if ($usuario->getUsDeshabilitado()) {
      $usuariosDeshabilitados[] = $usuario;
    } else {
      $usuariosHabilitados[] = $usuario;
    }
  }

  if ($usuariosHabilitados) {
    usort($usuariosHabilitados, "cmp");
  }

  if ($usuariosDeshabilitados) {
    usort($usuariosDeshabilitados, "cmp");
  }

  $resultado = array_merge($usuariosHabilitados, $usuariosDeshabilitados);
  return $resultado;
}

function strToCamelCase($string, $capitalizeFirstCharacter = false) {
  $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

  if (!$capitalizeFirstCharacter) {
    $str[0] = strtolower($str[0]);
  }

  return $str;
}

?>