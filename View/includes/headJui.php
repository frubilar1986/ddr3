<?php include_once "../config.php"; $sesion = new Session; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="sass/main.css">
   <!-- libreria jQuery_Easyui -->
      <!--<link rel="stylesheet" type="text/css" href="../util/jq_easyui/themes/black/easyui.css">
    <link rel="stylesheet" type="text/css" href="../util/jq_easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../util/jq_easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../util/jq_easyui/demo/demo.css">
    <script type="text/javascript" src="../util/jq_easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../util/jq_easyui/jquery.easyui.min.js"></script>
     -->
     <!-- libreria jeasyui -->
    
    <!-- <title>Build CRUD Application with edit form in expanded row details - jQuery EasyUI Demo</title> -->
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/black/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
    
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
   
    
    
</head>
<body>