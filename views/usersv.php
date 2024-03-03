<?php
require_once ('../lib/includes.php');
require_once DOCUMENT_ROOT.('/partials/header.php');
$Users = Model::load("Users");
if (!empty($_POST)){
$Users->save($_POST);
}
if (!empty($_POST['del-id'])){
$Users->delete($_POST['del-id']);
}
?>

        <?php if(isset($_SESSION['flash'])):?>
        <?php foreach($_SESSION['flash'] as $type =>$message):?>
        <div id="myAlert" class="alert alert-<?php echo $type;?> fade in" style="position: absolute; top: 70px; right: 1px; width: 500px;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?php echo $translate->__($message);?>
        </div>
        <?php endforeach;?>
        <?php unset($_SESSION['flash']);?>
        <?php endif;?>

<div class="container">
    <h1><?php echo $translate->__('Users Administration');?>
    <button class="btn btn-warning btn pull-right" id="any_button" data-toggle="modal" data-target="#add-modal"><?php echo $translate->__('Add new user');?></button>     
    </h1>        
  	<hr>
    <table id="userTable" class="table table-striped compact">
        <thead>
            <tr>
                <th><?php echo $translate->__('Id');?></th>
                <th><?php echo $translate->__('USERLOGIN');?></th>
                <th><?php echo $translate->__('USERNAME');?></th>
                <th><?php echo $translate->__('USERMAIL');?></th>
                <th><?php echo $translate->__('USERENVDEFAULT');?></th>
                <th><?php echo $translate->__('USERLANGUAGE');?></th>
                <th><?php echo $translate->__('USERTIMEDELAY');?></th>
                <th><?php echo $translate->__('ACTION');?></th>
            </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="edit-form" method="post">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit-modal-label"><?php echo $translate->__('Edit group info');?></h4>
                </div>

                <div class="modal-body">

                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#information"><?php echo $translate->__('Group information');?></a></li>
                        <li><a data-toggle="tab" href="#filter"><?php echo $translate->__('Filters');?></a></li>
                      </ul>

                      <div class="tab-content">
                        <div id="information" class="tab-pane fade in active">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input type="text" class="hidden" id="id" name="id" placeholder="id" value="" >
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="Name" class="col-sm-2 control-label"><?php echo $translate->__('GROUPLABEL');?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Name" name="Name" placeholder="<?php echo $translate->__('Name of the group');?>" value="" required>
                            </div>
                        </div>
                        </div>
                        <div id="filter" class="tab-pane fade">
                          <h3>Menu 1</h3>
                          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                      </div>



                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $translate->__('Cancel');?></button>
                        <button type="submit" class="btn btn-success"><?php echo $translate->__('Save Changes');?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="add-form" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit-modal-label"><?php echo $translate->__('Add new user');?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" value="" class="hidden">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Login:</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="USERLOGIN" type ="text" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $translate->__('First Name');?> :</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="USERNAME" type="text" value=""required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $translate->__('Last name');?> :</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="name" type="text" value=""required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="USERMAIL" type="text" value=""required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $translate->__('Default language');?> :</label>
                    <div class="col-lg-8">
                        <div id="user_language" data-input-name="USERLANGUAGE" data-button-size="btn-sm" data-button-type="btn-default" data-scrollable="true" data-scrollable-height="250px" data-countries='{"en_EN": "English","fr_FR": "Français","pt_PT": "Português","jp_JP": "日本語","cn_CN": "简体中文"}'>
                        </div>
                    </div>
                  </div> 
                  <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $translate->__('Time Zone');?> :</label>
                    <div class="col-lg-8">
                      <div class="ui-select">
                        <select id="user_time_zone" class="form-control" name="USERTIMEDELAY">
                          <option value="-5">(GMT-05:00) United States (Eastern Time Zone)</option>
                          <option value="-3">(GMT-03:00) Brazil</option>
                          <option value="0">(GMT 00:00) United Kingdom</option>
                          <option value="1">(GMT+01:00) France</option>
                          <option value="8">(GMT+08:00) Hong Kong</option>
                          <option value="9">(GMT+09:00) Japan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $translate->__('Cancel');?></button>
                        <button type="submit" class="btn btn-success"><?php echo $translate->__('Save Changes');?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="del-modal" tabindex="-1" role="dialog" aria-labelledby="del-modal-label">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="del-form" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="del-modal-label"><?php echo $translate->__('Please confirm delete of group');?></h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                           <div class="col-sm-10">
                                <input type="text" class="hidden" id="del-id" name="del-id" placeholder="ID" value="" hidden>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-10">
                                <input type="text" class="form-control" id="del-Name" name="Name" placeholder="<?php echo $translate->__('Name of the group');?>" value="" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $translate->__('Cancel');?></button>
                        <button type="submit" class="btn btn-success"><?php echo $translate->__('Confirm Delete');?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function () {
            event.preventDefault();
            var oTable = $('#userTable').DataTable({
                destroy: true,
                "iDisplayLength": 50,
                "sDom":"<'row'<'col-xs-3'l><'col-xs-4'T><'col-xs-5'f>r>"+"t"+"<'row'<'col-xs-6'i><'col-xs-6'p>>",
                "oTableTools": {
                    sSwfPath: "../css/plugins/TableTools/swf/copy_csv_xls_pdf.swf",
                    aButtons:     ['xls','pdf','print']
                },
                "language": {
                    "url": "../js/plugins/dataTables/locale/<?php echo $_SESSION['lang']?>.txt"
                },
                "ajax": "../model/getUsers.php",
                "error": "Cannot delete. Must delete ... first",
                "aoColumns": [
                                { "mData": "id" },
                                { "mData": "USERLOGIN" },
                                { "mData": "USERNAME" },
                                { "mData": "USERMAIL"},
                                { "mData": "USERENVDEFAULT" },
                                { "mData": "USERLANGUAGE" },
                                { "mData": "USERTIMEDELAY" },
                                { "sWidth": "100%"}                              
                            ],
                "aoColumnDefs": [
                                
                                    { className: "text-center",
                                      "aTargets": [ 7 ],
                                    "mRender": function ( data, type, full ) {
                                        return '<td>'+
                                            '<button class="btn btn-success btn-sm" data-id="" data-title="Edit" data-toggle="modal" data-target="#edit-modal">'+
                                                '<span class="fa fa-pencil"> <?php echo $translate->__('EDIT');?></span>'+
                                            '</button>'+ '    '+
                                            '<button class="btn btn-danger btn-sm" data-id="" data-title="del" data-toggle="modal" data-target="#del-modal">'+
                                                '<span class="fa fa-close"> <?php echo $translate->__('DELETE');?></span>'+
                                            '</button>'+
                                    '</td>'
                                    }
                                    }
                                ]              
                    });
                    $('#userTable').on('click', 'tr', function(event) {
                        var id = (oTable.row($(this).closest('tr')).data()['id']);
                           $.ajax({
                              type: "GET",
                              url: "../model/getUsers.php",
                              cache: false,
                              data: {userID: id},
                              dataType: 'json',
                              success:function(data){
                               // Test what is returned from the server
                                document.getElementById("id").value = id;
                                document.getElementById("Name").value = data["data"][0].USERLOGIN;
                                document.getElementById("del-id").value = id;
                                document.getElementById("del-Name").value = data["data"][0].USERLOGIN;
                                                    

                              }
                            });
                    });
                        $('#user_language').flagStrap();
                        $("#myAlert").fadeToggle(3000);

                        var selectedTimeZone = "<?php Print($user->timeZone); ?>";
                        document.getElementById('user_time_zone').value = selectedTimeZone;
                        $('#user_time_zone').selectpicker('refresh');
                                });
        </script>
<?php  include '../partials/footer.php'; ?> 
