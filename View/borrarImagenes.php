<?php
include_once "../config.php";

$data = data_submitted();

array_map('unlink', glob($ROOT . "View/img/Productos/" . md5($data['id']) . "/*.jpg"));

echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
