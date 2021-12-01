<?php
include_once "../config.php";
$sesion->cerrar();


header("Status: 301 Moved Permanently");
header("Location: login.php");

exit;
