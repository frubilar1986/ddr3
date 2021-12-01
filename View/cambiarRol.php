<?php
include_once '../config.php';
$data = data_submitted();
$url = $data['url'];



header("Status: 301 Moved Permanently");
if (isset($data['idrol'])) {
  $_SESSION['rol'] = $data['idrol'];
  header("Location: comprar.php");
}
