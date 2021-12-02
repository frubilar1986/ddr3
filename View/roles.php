<?php $title = 'Roles de usuarios';
include_once('../config.php');
$sesion = new Session();
include_once './includes/head.php';
include_once "./includes/navbar.php";
//if ($sesion->activa() && $sesion->getRolActual() == 1) {
    //$accesoPag = new ctrolPagina;
   // $access = $accesoPag->ctrl_acceso();
   $nameMenuBd = 'Roles';
   $data = data_submitted();
   mostrarArray($data);
   mostrarArray($_SESSION);
    $accesoPag = new CtrolPagina;
    if(isset($data['idmenu'])){
        $_SESSION['idmenu'] = $data['idmenu'];
    }
    $access = $accesoPag->ctrl_acceso($_SESSION,$nameMenuBd);
?>


    <!-- body -->
    <?php if ($access) { ?>
    <br><br>
    <div class='container '>
        <h2 class="text-danger ">!Para realizar cambios,  seleccione una fila.!</h2>
        <table id="dgRol" title="Roles del sistema" class="easyui-datagrid  " style="width:650px;height:300px ; " url="accion/listarRoles.php" toolbar="#toolbarRol" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <!-- <th field="idrol" width="5">Id</th> -->
                    <th field="rodescripcion" width="20">Detalle</th>
                    <!-- <th field="uspass" width="120">password</th>
                <th field="usmail" width="100">Email</th>
                <th field="usdeshabilitado" width="70">Baja</th> -->
                </tr>
            </thead>
        </table>
        <div id="toolbarRol">
            <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoRol()">Nuevo Rol</a> -->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarRol()">Editar Rol</a>
            <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="eliminarRol()">Elminar Rol</a> -->
        </div>
        <br>
        <hr>
        <div id="dlgRol" class="easyui-dialog " style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlgRol-buttons'">
            <form id="fmRol" method="post" class="needs-validation" data-toggle="validator" novalidate style="margin:0;padding:20px 50px">
                <h4 class="text-warning "> Nombre del rol</h4>
                <div style="margin-bottom:10px">
                    <input name="rodescripcion" class="easyui-textbox " required placeholder="descr del rol" pattern="^[A-Za-z ]*$" label="Descripcion" style="width:70%">
                </div>

                <div>
                    <input name="idrol" value="idrol" type="hidden">
                    <!-- <input name="usdeshabilitado" value='usdeshabilitado' type="hidden">  -->
                </div>
                <!-- <div>
                <input name="Act" value="idusuario" type="checkbox">
            </div> -->
            </form>
        </div>
        <div id="dlgRol-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUserRol()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRol').dialog('close')" style="width:90px">Cancelar</a>
        </div>


        <script type="text/javascript">
            var url;

            function nuevoRol() {
                $('#dlgRol').dialog('open').dialog('center').dialog('setTitle', 'Crear nuevo rol');
                $('#fmRol').form('clear');
                url = 'accion/newRol.php';
            }

            function editarRol() {
                var row = $('#dgRol').datagrid('getSelected');
                if (row) {
                    $('#dlgRol').dialog('open').dialog('center').dialog('setTitle', 'Editar descripcion de rol');
                    $('#fmRol').form('load', row);
                    url = 'accion/modRol.php?idrol=' + row.id;
                }
            }

            function saveUserRol() {
                $('#fmRol').form('submit', {
                    url: url,
                    iframe: false,
                    onSubmit: function() {
                        return $(this).form('validate');
                    },
                    success: function(result) {
                        var result = eval('(' + result + ')');

                        if (result.errorMsg) {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                            $('#dlgRol').dialog('close'); // close the dialog
                            $('#dgRol').datagrid('reload'); // reload the user data
                        }
                    }
                });
            }

            function eliminarRol() {
                var row = $('#dgRol').datagrid('getSelected');
                if (row) {
                    $.messager.confirm('Confirm', ' Esta seguro de eliminar Rol?', function(r) {
                        if (r) {
                            $.post('accion/bajaRol.php', {
                                idrol: row.idrol
                            }, function(result) {
                                if (result.respuesta) {
                                    console.log(result);
                                    $('#dgRol').datagrid('reload'); // reload the user data
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

        <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- agragar roles a los usuarios ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <h2 class="text-danger "></h2>
        <table id="dg" title="agregar o quiter roles a usuarios" class="easyui-datagrid  " style="width:650px;height:500px ; " url="accion/listarUsRol.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="usnombre" width="100">Nombre de usuario</th>
                    <!-- <th field="menombre" width="50">Nombre</th> -->
                    <!-- <th field="medescripcion" width="120">Descripcion</th> -->
                    <th field="rodescripcion" width="100">Rol que posee</th>
                    <!-- <th field="medeshabilitado" width="70">Baja</th> -->
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser(),$('#idrol').combobox('reload', 'accion/listarRoles.php')">Asignar Rol a usuario</a>
            <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar menu</a> -->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">eliminar Rol del usuario</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" class="needs-validation" method="post" novalidate style="margin:0;padding:20px 50px">
                <h4 class="text-warning ">Elegir rol y usuario</h4>
                <!-- <div style="margin-bottom:10px">
                <input name="menombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div> -->
                <!-- <div style="margin-bottom:10px">
                <input name="medescripcion" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
            </div> -->
                <div>
                    <h2>Usuario</h2>
                    <!-- <p>Por defecto, estara deshabilitada...</p>  -->
                    <div style="margin:20px 0"></div>
                    <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
                        <div style="margin-bottom:20px">
                            <input class="easyui-combobox" id="idusuario" required='true' name="idusuario" style="width:100%;" data-options="
                    url:'accion/listarUsuarios.php',
                    select:'',
                    method:'post',
                    valueField:'idusuario',
                    textField:'usnombre',
                    panelHeight:'auto',
                    iconWidth:22,
                    
                    label: 'Usuario registrado:',
                    labelPosition: 'top'
                    ">
                        </div>
                    </div>
                </div>
                <div>
                    <h2>Rol a asignar</h2>
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
                url = 'accion/newUsuarioRol.php';
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

                        if (result.errorMsg) {
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
                            url = 'accion/bajaRolUsuario.php';
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
<?php include_once("./includes/footerui.php"); ?>
<!-- <script src="./js/filtroCursos.js"></script> -->