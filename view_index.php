<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="easyui/demo/demo.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Sinkron Data</h2>
    <p>Click the buttons on datagrid toolbar to do crud actions.</p>
    
    <table id="dg" title="My Users" class="easyui-datagrid" style="width:100%;height:500px"           
            
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="nip_lama" width="10">Nip Lama</th>
                <th field="nip_baru" width="20">Nip Baru</th>
                <th field="nama_lengkap" width="50">Nama Lengkap</th>
                <th field="nama_jabatan" width="50">Jabatan</th>
                <th field="unit_kerja" width="50">Unit Kerja</th>
            </tr>
        </thead>
    </table>
    <div id="tb" style="padding:3px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="AddAction()" >Add Action</a>
       
        <div style="float: right;margin-right: 20px;">
            <span>Search:</span>
            <input id="searchid" style="line-height:26px;border:1px solid #ccc">
            <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" onclick="doSearch()">Search</a>
        </div>

        
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:600px;height:250px;padding:10px 30px;"
        title="Register"  data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <h2>Account Information</h2>
        <form id="ff" method="post" >
            <table>
                <tr>
                    <td>Nama Lengkap:</td>
                    <td>
                      <input id="pg" class="easyui-combobox" name="nama_lengkap" style="width:400px;">
                                   
                    </td>
                </tr>
                <tr>
                    <td>Jabatan:</td>
                    <td>
                      <input id="jb" class="easyui-combobox" name="nama_jabatan" style="width:300px;">
                                   
                    </td>
                </tr>

                <tr>
                    <td>Unit Kerja:</td>
                    <td>
                      <input id="uk" class="easyui-combobox" name="unit_kerja" style="width:400px;">
                                   
                    </td>
                </tr>
                
            </table>

        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>
   


    <script type="text/javascript">
        var url;
        $(function(){
            $('#dg').datagrid({
                url:'get_index.php',
                toolbar: '#tb',
                pagination:'true'
                
            });

            $('#pg').combobox({

                url:'cb_pegawai.php',
                valueField:'id',
                textField:'nama_lengkap',
                formatter:function(row){                   
                    return '<b>'+row.nip_baru+'</b><br> '+row.nama_lengkap+'</span>';
                }
            });

            $('#jb').combobox({

                url:'cb_jabatan.php',
                valueField:'id',
                textField:'nama_jabatan',
                formatter:function(row){                   
                   return '<b>'+row.kode_jabatan+'</b><br> '+row.nama_jabatan+'</span>';
                }
            });

            $('#uk').combobox({

                url:'cb_struktural.php',
                valueField:'id',
                textField:'unit_kerja',
                formatter:function(row){                   
                   return '<b>'+row.kode+'</b><br> '+row.unit_kerja+'</span>';
                }
            });
        });

        function doSearch(){
            $('#dg').datagrid('load',{
                searchid: $('#searchid').val()               
            });
        }
        
        function AddAction(){           
            var row = $('#dg').datagrid('getSelected');
            
            if (row.id==null){
               $('#dlg').dialog('open').dialog('center').dialog('setTitle','New');
                $('#ff').form('clear');
                url = 'save_index.php';
            }
            else{
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit');
                $('#ff').form('load',row);
                url = 'update_index.php?id='+row.id;
            }

        }

        function saveUser(){
            $('#ff').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
    </script>
</body>
</html>