<?php $title = 'Abm menues';
include_once('../config.php');
$sesion = new Session();
include_once './includes/headjui.php';
include_once "./includes/navbar.php";
//if ($sesion->activa() && $sesion->getRolActual() == 1) {
   
    $data = data_submitted();
    $accesoPag = new ctrolPagina;
    if(isset($data['idmenu'])){
        $_SESSION['idmenu'] = $data['idmenu'];
    }
    $access = $accesoPag->ctrl_acceso($_SESSION);
?>


    <!-- comienzo codigo pagina -->

    <div class='container '>
    <?php if ($access) { ?>
        <table id="dg" title="Alta Baja Modif de menus" class="easyui-datagrid  " style="width:950px;height:500px ; " url="accion/listarMenu.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="idmenu" width="20">Id</th>
                    <th field="menombre" width="">Nombre</th>
                    <th field="medescripcion" width="">Descripcion</th>
                    <th field="idpadre" width="100">Menu padre</th>
                    <th field="medeshabilitado" width="70">Baja</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Crear menu</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser(),$('#idpadre').combobox('reload')">Editar menu</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">deshab./ activ menu</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h4 class="text-warning ">Informacion del menu</h4>
                <div style="margin-bottom:10px">
                    <input name="menombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="medescripcion" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
                </div>
                <div>
                    <h2>Que usuario ver&aacute; esta opcion</h2>
                    <p class = 'bg-warning text-danger '>Despues de creada, debe habilitar la opcion</p>
                    <div style="margin:20px 0"></div>
                    <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
                        <div style="margin-bottom:20px">
                            <input class="easyui-combobox" id="idpadre" required='true' name="idpadre" style="width:100%;" data-options="
                    url:'accion/listarMenuPadre.php',
                    select:'',
                    method:'post',
                    valueField:'idmenu',
                    textField:'menombre',
                    panelHeight:'auto',
                    iconWidth:22,
                    
                    label: 'Menu padre:',
                    labelPosition: 'top'
                    ">
                        </div>
                    </div>
                </div>
                <!-- <div style="margin-bottom:10px">
                <input name="usmail" class="easyui-textbox" required="true" label="email:" style="width:100%">
            </div> -->
                <div>
                    <input name="medeshabilitado" value='medeshabilitado' type="hidden">
                    <!-- <input name="usdeshabilitado" value='usdeshabilitado' type="hidden">  -->
                </div>
                <div>
                    <input name="idmenu" value="idmenu" type="hidden">
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
                url = 'accion/newMenu.php';
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
                            url = 'accion/bajaMenu.php';
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
                                        $('#dg').datagrid('reload'); // reload the menu data
                                    }
                                }
                            });
                        }
                    });
                }
            }
        </script>
    <?php } else { ?>
        <div class="container d-flex justify-content-center align-items-start text-center mt-5">
            <div class="alert alert-danger mt-20vh" role="alert">
                <h4 class="alert-heading">Esta pagina es solo para administradores</h4>
            </div>
        </div>
    <?php } ?>
    <!-- fin code pag -->
    <br>
    <br>
    <?php include_once("./includes/footerui.php"); ?>
    <!-- <script src="./js/filtroCursos.js"></script> -->