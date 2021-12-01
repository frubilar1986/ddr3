<?php $title = 'Estado de Compra';
include_once './includes/head.php'; ?>
<?php include_once "./includes/navbar.php"; ?>
<?php
/* Primero saco la/s compra/s con el idusuario */
// mostrarArray($_SESSION);
// echo $precioTotal;

if (!isset($_SESSION["idusuario"])) {
    header('Location: http://localhost/PWD_TPFinal/View/paginaSegura.php');
}

if (isset(data_submitted()["compraexitosa"])) {
    if (data_submitted()["compraexitosa"]) {
?>
        <div class="bg-success text-white">Compra realizada exitosamente</div>
    <?php } else {

    ?>
        <div class="bg-danger text-white">Compra realizada exitosamente</div>

<?php
    }
}




// mostrarArray($_SESSION);
$abmCompra = new AbmCompra();
if ($sesion->getRolActual() == 2) {
    $arrCompras = $abmCompra->buscar("");
} else {
    $datos["idusuario"] = $_SESSION["idusuario"];
    $arrCompras = $abmCompra->buscar($datos);
}
// mostrarArray($arrCompras);
/* Saco los tipo de estado */
$abmEstadoTipo = new AbmCompraEstadoTipo();
$arrEstadoTipo = $abmEstadoTipo->buscar("");
// mostrarArray($arrProductos);
$abmCompraItem = new AbmCompraItem();
?>

<h2 class="container my-5">Estado de Compra</h2>

<?php
$arrCompras = array_reverse($arrCompras);
foreach ($arrCompras as $compra) {
    $precioTotal = 0;
    $abmCompraEstado = new AbmCompraEstado();
    $paramIdCompra["idcompra"] = $compra->getIdCompra();
    $estado = $abmCompraEstado->buscar($paramIdCompra);
    $arrItems = $abmCompraItem->buscar($paramIdCompra);
?>
    <div class="container d-flex">
        <div class="w-25">
            <h5>Identificador de Compra: <?= $compra->getIdCompra(); ?></h5>
            <?php
            if ($sesion->getRolActual() == 2 && ($compra->getObjUsuario()->getIdUsuario() != $sesion->getRolActual() || $estado != null)) {
                echo "<span class='mb-2 badge bg-primary'>ID Usuario: {$compra->getObjUsuario()->getIdUsuario()}</span>
                ";
            }
            ?>
            <p class="fw-bold">Estado Actual:
                <?php
                $idTipoEstado["idcompraestadotipo"] = $estado[0]->getObjCompraEstTipo()->getIdCompraEstTipo();
                $tipoEstado = $abmEstadoTipo->buscar($idTipoEstado);
                echo ucfirst($tipoEstado[0]->getCetDescripcion());
                ?>
            </p>
            <p>Productos:
                <?php
                foreach ($arrItems as $item) {
                    if($item->getCiCantidad() > 0) {
                        echo $item->getObjProducto()->getProNombre() . " ({$item->getCiCantidad()})";
                    }
                    
                    if (next($arrItems)) {
                        echo ", ";
                    } else echo ".";

                    if ($item->getObjProducto()->getProPrecioOferta() != null) {
                        $precioTotal += $item->getObjProducto()->getProPrecioOferta() * $item->getCiCantidad();
                    } else {
                        $precioTotal += $item->getObjProducto()->getProPrecio() * $item->getCiCantidad();
                    }
                }
                ?>

            </p>
            <p>
                <?php
                // mostrarArray($item);
/*                 foreach ($arrItems as $item) {

                    if ($item->getObjProducto()->getProPrecioOferta() != null) {
                        $precioTotal += $item->getObjProducto()->getProPrecioOferta() * $item->getCiCantidad();
                    } else {
                        $precioTotal += $item->getObjProducto()->getProPrecio() * $item->getCiCantidad();
                    }
                } */
                echo "Total: $" . $precioTotal; ?>

            </p>


        </div>
        <div class="w-75 progreso d-flex align-items-center justify-content-center">
            <ul class="p-0 ms-5 mt-5 d-flex ">
                <div class="estado-1 d-flex flex-column">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 1) { ?> estado-activo <?php } ?>text-center" style="width: 30px;">1</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[0]->getCetDescripcion()); ?></li>
                </div>
                <div class="estado-1">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 2) { ?> estado-activo <?php } ?>text-center" style="width: 30px;">2</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[1]->getCetDescripcion()); ?></li>
                </div>
                <div class="estado-1">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 3) { ?> estado-activo <?php } ?>text-center" style="width: 30px;">3</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[2]->getCetDescripcion()); ?></li>
                </div>
                <div class="estado-1">
                    <p class="mb-3 estado <?php
                                            if ($idTipoEstado["idcompraestadotipo"] == 4) { ?> bg-danger <?php } ?>text-center" style="width: 30px;">4</p>
                    <li class="w-100" style="margin: 0 120px 0 0"><?= ucfirst($arrEstadoTipo[3]->getCetDescripcion()); ?></li>
                </div>


            </ul>
        </div>
        <?php

        if ($sesion->getRolActual() == 2 && $idTipoEstado["idcompraestadotipo"] != 4) {

        ?>
            <div class="d-flex flex-column justify-content-center align-items-center w-25">
                <form class="d-flex flex-column justify-content-center align-items-center " action="../Controller/cambiarEstado.php" method="POST">
                    <select class="form-select" name="nuevoestado">
                        <option selected>Cambiar estado</option>
                        <option value="1">Iniciada</option>
                        <option value="2">Aceptada</option>
                        <option value="3">Enviada</option>
                    </select>
                    <input type="text" style="display: none;" value="<?= $compra->getIdCompra(); ?>" name="idcompra">
                    <button class="btn btn-primary mt-3" type="submit">Confirmar cambio</button>
                </form>
            </div>
        <?php } ?>
        <div class="ms-5 d-flex justify-content-center align-items-center">
            <form method="POST" action="../Controller/cancelarCompra.php">
                <input class="" style="display: none;" type="number" name="idcompracancelar" for="idcompracancelar" value='<?= $compra->getIdCompra() ?>'>
                <button class="btn btn-danger" type="submit" <?php if ($idTipoEstado["idcompraestadotipo"] == 4) { ?> disabled <?php } ?>>Cancelar Compra</button>
            </form>
        </div>


    </div>
    <div class="container">
        <hr>
    </div>
<?php
} ?>
<div class="container" style="margin-top: 100px;">
    <hr>
</div>

<?php include_once "./includes/footer.php"; ?>