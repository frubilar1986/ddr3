<?php $title = 'Administrar usuarios';
include_once('../config.php');
$sesion = new Session();
include_once './includes/head.php';
include_once "./includes/navbar.php";
// if ($sesion->activa() && $sesion->getRolActual() == 1) {
    // $accesoPag = new ctrolPagina;
    // $access = $accesoPag->ctrl_acceso();
    $data = data_submitted();
    $accesoPag = new ctrolPagina;
    if(isset($data['idmenu'])){
        $_SESSION['idmenu'] = $data['idmenu'];
    }
    $access = $accesoPag->ctrl_acceso($_SESSION);

?>

    <!-- body -->
    <br><br>

    <!-- /////////////////////////////////////// -->
    <!-- agragar menu individuales  a los usuarios -->
    <!-- ///////////////////////////////////////// -->
    <div class="container">
    <?php if ($access) { ?>
        <table id="dgRolUs" title="Asignar menus a usuarios" class="easyui-datagrid" style="width:700px;height:500px" url="accion/listarMrol.php" toolbar="#toolbarRolUs" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <!-- <th field="idusuario" width="50">ID</th> -->
                    <th field="menombre" width="50">Menues </th>
                    <!-- <th field="idrol" width="50">Rol</th> -->
                    <th field="rodescripcion" width="50">Rol que puede acceder</th>
                </tr>
            </thead>
        </table>

        <div id="toolbarRolUs">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUsRol()">Agregar rol a usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUsRol()">Eliminar Rol Usuario</a>
        </div>

        <div id="dlgRolUs" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRolUs-buttons'">
            <form id="fmRolUs" method="post" novalidate style="margin:0;padding:20px 50px">
                <!-- <h6>Informacion UsuarioRol</h6> -->
                <p class="text-warning h6">Selecionar un Rol de sistema</p>
              
                <div class="easyui-panel" style="width:100%;max-width:400px;padding:10px 60px;">
                    <div style="margin-bottom:20px">
                        <select id="idrol" name="idrol" class="easyui-combogrid" style="width:100%" data-options="
                    panelWidth: 300,
                    idField: 'idrol',
                    textField: 'rodescripcion',
                    url: 'accion/listarRoles.php',
                    method: 'post',
                    columns: [[
                        {field:'idrol',title:' ID',width:80},
                        {field:'rodescripcion',title:'Descripcion',width:120},
                        
                    ]],
                    fitColumns: true,
                    label: 'Roles:',
                    labelPosition: 'top'
                ">
                        </select>
                    </div>
                </div>
                <p class="text-warning h6">Selecionar un usuario de sistema</p>
                <!-- <div style="margin-bottom:10px">
                <input name="idrol" class="easyui-textbox" required="true" label="ID Rol:" style="width:100%">
            </div> -->
                <!-- <div style="margin:20px 0">
                <input type="checkbox" checked onchange="$('#ccU').combogrid({selectOnNavigation:$(this).is(':checked')})">
                <span>SelectOnNavigation</span>
            </div> -->
                <div class="easyui-panel" style="width:100%;max-width:400px;padding:10px 60px;">
                    <div style="margin-bottom:20px">
                        <select id="idusuario" name="idusuario" class="easyui-combogrid" style="width:100%" data-options="
                    panelWidth: 300,
                    idField: 'idusuario',
                    textField: 'usnombre',
                    url: 'accion/listarUsuarios.php',
                    method: 'get',
                    columns: [[
                        {field:'idusuario',title:'ID',width:80},
                        {field:'usnombre',title:'Nombre',width:120},
                        
                    ]],
                    fitColumns: true,
                    label: 'Usuarios:',
                    labelPosition: 'top'
                ">
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div id="dlgRolUs-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsRol()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRolUs').dialog('close')" style="width:90px">Cancelar</a>
        </div>
        <script>
            function newUsRol() {
                $('#dlgRolUs').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Rol a Usuario');
                $('#fmRolUs').form('clear');
                url = 'accion/newUsuarioRol.php';
            }

            function saveUsRol() {
                $('#fmRolUs').form('submit', {
                    url: url,
                    iframe: false,
                    onSubmit: function() {
                        return $(this).form('validate');
                    },
                    success: function(result) {
                        var result = eval('(' + result + ')');
                        console.log(result);
                        if (result.errorMsg) {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                            $('#dlgRolUs').dialog('close'); // close the dialog
                            $('#dgRolUs').datagrid('reload'); // reload the user data
                        }
                    }
                });
            }

            function destroyUsRol() {
                var row = $('#dgRolUs').datagrid('getSelected');
                if (row) {
                    $.messager.confirm('Confirm', 'eliminar rols al usuario?', function(r) {
                        if (r) {
                            $.post('accion/admin/baja_usuarioRol.php', {
                                idusuario: row.idusuario,
                                idrol: row.idrol
                            }, function(result) {
                                if (result.respuesta) {
                                    $('#dgRolUs').datagrid('reload'); // reload the user data
                                } else {
                                    $.messager.show({ // show error message
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                }
                            }, 'json');
                        }
                    });
                }
            }
        </script>
        <!-- fin de datagrid dpara agregar roles a los usuarios -->


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
<script src="./js/filtroCursos.js"></script>