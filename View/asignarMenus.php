<?php $title = 'Asignar menu a usuario';
include_once('../config.php');
$sesion = new Session();
include_once './includes/head.php';
include_once "./includes/navbar.php";
$nameMenuBd = "Asignar menus";
    $data = data_submitted();
    $accesoPag = new CtrolPagina;
    if(isset($data['idmenu'])){
        $_SESSION['idmenu'] = $data['idmenu'];
    }
    $access = $accesoPag->ctrl_acceso($_SESSION,$nameMenuBd);
?>


    <!-- body -->
    <br><br>

    <!-- /////////////////////////////////////// -->
    <!-- agragar menu individuales  a los usuarios -->
    <!-- ///////////////////////////////////////// -->
    <div class="container">
    <?php if ($access) { ?>
    <table id="dg" title="agregar o quitar acceso a menus" class="easyui-datagrid  " style="width:650px;height:500px ; " url="accion/listarMrol.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="menombre" width="100">Menues</th>
                    <!-- <th field="menombre" width="50">Nombre</th> -->
                    <!-- <th field="medescripcion" width="120">Descripcion</th> -->
                    <th field="rodescripcion" width="100">Rol con acceso</th>
                    <!-- <th field="medeshabilitado" width="70">Baja</th> -->
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser(),$('#idrol').combobox('reload', 'accion/listarRoles.php')">Nuevo permiso a menu</a>
            <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar menu</a> -->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">eliminar permiso al Rol</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" class="needs-validation" method="post" novalidate style="margin:0;padding:20px 50px">
                <h4 class="text-warning ">Elegir menu y rol</h4>
                <!-- <div style="margin-bottom:10px">
                <input name="menombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div> -->
                <!-- <div style="margin-bottom:10px">
                <input name="medescripcion" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
            </div> -->
                <div>
                    <h2>Menus</h2>
                    <!-- <p>Por defecto, estara deshabilitada...</p>  -->
                    <div style="margin:20px 0"></div>
                    <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
                        <div style="margin-bottom:20px">
                            <input class="easyui-combobox" id="idmenu" required='true' name="idmenu" style="width:100%;" data-options="
                    url:'accion/listarMenu.php',
                    select:'',
                    method:'post',
                    valueField:'idmenu',
                    textField:'menombre',
                    panelHeight:'auto',
                    iconWidth:22,
                    
                    label: 'Menus de opciones:',
                    labelPosition: 'top'
                    ">
                        </div>
                    </div>
                </div>
                <div>
                    <h2>Roles</h2>
                    <!-- <p>Por defecto, estara deshabilitada...</p>  -->
                    <div style="margin:20px 0"></div>
                    <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
                        <div style="margin-bottom:20px">
                            <input class="easyui-combobox" id="idrol" required='true' name="idrol" style="width:100%;" data-options="
                    url:'accion/listarRoles.php',
                    select:'',
                    method:'post',
                    valueField:'idrol',
                    textField:'rodescripcion',
                    panelHeight:'auto',
                    iconWidth:22,
                    
                    label: 'Roles de sistema:',
                    labelPosition: 'top'
                    ">
                        </div>
                    </div>
                </div>
                <!-- <div style="margin-bottom:10px">
                <input name="usmail" class="easyui-textbox" required="true" label="email:" style="width:100%">
            </div> -->
                <div>
                    <!-- <input name="medeshabilitado" value='medeshabilitado' type="hidden"> -->
                    <!-- <input name="usdeshabilitado" value='usdeshabilitado' type="hidden">  -->
                </div>
                <div>
                    <!-- <input name="idmenu" value="idmenu" type="hidden"> -->
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
        <script type="text/javascript">
            var url;

            function newUser() {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Crear menu');
                $('#fm').form('clear');
                url = 'accion/newMenurol.php';
            }

            function editUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Usuario');
                    $('#fm').form('load', row);
                    url = 'accion/modMenu.php';
                }
            }

            function saveUser() {
                $('#fm').form('submit', {
                    url: url,
                    iframe: false,
                    onSubmit: function() {
                        return $(this).form('validate');
                    },
                    success: function(result) {
                        var result = eval('(' + result + ')');

                        if (!result.respuesta) {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                            $('#dlg').dialog('close'); // close the dialog
                            $('#dg').datagrid('reload'); // reload the user data
                        }
                    }
                });
            }



            function destroyUser() {
                var row = $('#dg').datagrid('getSelected');
                console.log(row);
                if (row) {
                    $.messager.confirm('Cambiar', ' cambiar estado de usuario??', function(r) {
                        if (r) {
                            $('#fm').form('load', row);
                            url = 'accion/bajaMenuRol.php';
                            $('#fm').form('submit', {
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
                                        $('#dg').datagrid('reload'); // reload the menu data
                                    }
                                }
                            });
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