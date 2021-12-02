<?php $title = 'Administrar usuarios';
include_once('../config.php');
$sesion = new Session();
include_once './includes/headJui.php';
include_once "./includes/navbar.php";

/* if ($sesion->activa() && $sesion->getRolActual() == 1) { */
//$accesoPag = new ctrolPagina;
//$access = $accesoPag->ctrl_acceso();
$nameMenuBd = "Roles de usuarios";
$data = data_submitted();
    $accesoPag = new ctrolPagina;
    if(isset($data['idmenu'])){
        $_SESSION['idmenu'] = $data['idmenu'];
    }
    $access = $accesoPag->ctrl_acceso($_SESSION,$nameMenuBd);
?>

<?php if ($access) { ?>
    

    <!-- body -->
    <br><br>
    <div class='container '>
        <h2>Verificar los roles que posee cada usuario</h2>
        <div style="margin-bottom:10px">
            <p>Click en el signo + ( mas ) para observar roles de usuario</p>
        </div>

        <table id="dg" style="width:750px;height:550px" url="accion/listarUsuarios.php" title="Todos los usuaarios registrados" singleSelect="true" fitColumns="true">
            <thead>
                <tr>
                    <th field="idusuario" width="80"> ID</th>
                    <th field="usnombre" width="100">nombre</th>
                    <th field="usmail" align="center" width="100">mail</th>
                    <th field="usdeshabilitado" align="right" width="80">fecha de baja</th>
                    <!--<th field="attr1" width="220">Attribute</th>
                <th field="status" width="60" align="center">Status</th> -->
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            $(function() {
                $('#dg').datagrid({
                    view: detailview,
                    detailFormatter: function(index, row) {
                        return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
                    },
                    onExpandRow: function(index, row) {
                        var ddv = $(this).datagrid('getRowDetail', index).find('table.ddv');
                        ddv.datagrid({
                            url: 'accion/listarUsRol.php?idusuario=' + row.idusuario,

                            fitColumns: true,
                            singleSelect: true,
                            rownumbers: true,
                            loadMsg: '',
                            height: 'auto',
                            columns: [
                                [{
                                        field: 'idrol',
                                        title: 'idrol',
                                        width: 20
                                    },
                                    {
                                        field: 'rodescripcion',
                                        title: 'descripcion',
                                        width: 100,
                                        align: 'left'
                                    },
                                    // {field:'unitprice',title:'Unit Price',width:100,align:'right'}
                                ]
                            ],
                            onResize: function() {
                                $('#dg').datagrid('fixDetailRowHeight', index);
                            },
                            onLoadSuccess: function() {
                                setTimeout(function() {
                                    $('#dg').datagrid('fixDetailRowHeight', index);
                                }, 0);
                            }
                        });
                        $('#dg').datagrid('fixDetailRowHeight', index);
                    }
                });
            });
        </script>
    </div>
<?php } else { ?>
    <div class="container d-flex justify-content-center align-items-start text-center mt-5">
        <div class="alert alert-danger mt-20vh" role="alert">
            <h4 class="alert-heading">Esta pagina es solo para administradores</h4>
        </div>
    </div>
<?php } ?>
<br>
<br>
<?php include_once "./includes/footerui.php"; ?>
<!-- <script src="./js/filtroCursos.js"></script> -->