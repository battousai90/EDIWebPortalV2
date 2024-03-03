<?php
require_once ('../lib/includes.php');
require_once DOCUMENT_ROOT.('/partials/header.php');

$mail = New Mail();
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
        <h1><?php echo $translate->__('Edit Mailing List');?></h1>
  	    <hr>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $translate->__('Process List');?></div>
                <div class="panel-body">   
                        <p style="font-size: 11px"><?php echo $translate->__('Select your environment');?></p>
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <select class="selectpicker form-control" data data-live-search="true" data-style="btn-primary" data-loading-text="Processing Order" size="18" id="formEnvironment" name="formEnvironment" style="font-size: 14px;padding-bottom: 20px" onchange="this.form.submit();">
                              <?php                                 
                                echo '<option value="'.$_SESSION['environmentID'].'" selected>'.$_SESSION['environment'].'</option>';
                                Foreach($user->environment as $environment){
                                echo '<option value="'.$environment['ENVID'].'">'.$environment['ENVNAME'].'</option>';
                            } ?>
                        </select>
                        </form>
                        <p></p>
                        <p style="font-size: 11px"><?php echo $translate->__('Select a process');?></p>
                        <select class="selectpicker form-control"  title="<?php echo $translate->__('Please choose a process');?>" data-live-search="true" data-style="btn-info" size="18" id="formProcess" style="font-size: 14px;padding-bottom: 20px">
                            <?php                                
                                Foreach($mail->mailEnvProcessList as $process){
                                echo '<option value="'.$process['PROCESSNAME'].'#'.$process['PROCESSCOUNTRY'].'">'.$process['PROCESSLABEL'].'</option>';
                            } ?>
                        </select>
                        <p></p>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addProcess" name="addProcessBtn" id="addProcessBtn">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $translate->__('Add a process');?>
                        </button>
                        <p></p>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addEmail" name="addEmailBtn" id="addEmailBtn">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo $translate->__('Add an email');?>
                        </button>
                        <p></p>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#emailSearch" name="emailSearchBtn" id="emailSearchBtn">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> <?php echo $translate->__('Search mail');?>
                        </button>
                    <div id="result"></div>                        
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $translate->__('Mail recipient List');?></div>
                <!-- WAITING -->
                <div id="wait" style="display:none;position: absolute;top: 50%; left: 46%; z-index: 1000;">
                   <i class="fa fa-spinner fa-pulse fa-5x" style="color: #337ab7"></i>
                </div>
                <!-- WAITING END -->
                <div class="panel-body">
                    <form id="mailingListform" action="#" method="post">
                        <select multiple="multiple" size="12" name="mailingList[]" id="arearesults">
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success" name="submiEmailBtn" id="submiEmailBtn"><?php echo $translate->__('Submit the mailing list');?></button>
                  </form>
                </div>
            </div>
        </div>

    </div>
        <!--ADD PROCESS MODAL-->
          <div id="addProcess" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?php echo $translate->__('Add a process');?></h4>
                    </div>
                    <form action="/model/add_MaillingProcess.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                            <select class="selectpicker form-control" data-live-search="true" data-style="btn-info" size="18" name="processName" id="formEnvironment" style="font-size: 14px;padding-bottom: 20px">
                                <?php 
                                    Foreach($mail->envProcessList as $process){
                                    echo '<option value="'.$process['PNAME'].'">'.$process['PNAME'].'</option>';
                                } ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="processLabel" type="text" value=""required placeholder="<?php echo $translate->__('Process Label');?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="processCountry" type="text" value="" maxlength="2" placeholder="<?php echo $translate->__('Process Country 2 Letter (ex : BE, LU, FR)');?>">
                            </div> 
                            <h5 class="modal-title"><?php echo $translate->__('Beware Mail');?></h5>
                        </div>                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $translate->__('Cancel');?></button>
                            <button type="submit" class="btn btn-primary"><?php echo $translate->__('Add a process');?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--ADD PROCESS MODAL END-->

        <!--ADD EMAIL MODAL-->
          <div id="addEmail" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?php echo $translate->__('Add an email');?></h4>
                    </div>
                    <form action="/model/add_MailingEmail.php" method="post" name="form1">
                        <div class="modal-body">
                            <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="optionsRadios1">
                                        <?php echo $translate->__('Internal Email');?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" checked="checked">
                                        <?php echo $translate->__('External Email');?>
                                    </label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="emailName" type="text" value=""required placeholder="<?php echo $translate->__('User Name');?>" onchange="myFunction()">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="emailFirstName" type="text" value=""required placeholder="<?php echo $translate->__('User Firstname');?>" onchange="myFunction()">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="emailEmail" type="text" value=""required placeholder="<?php echo $translate->__('User Email');?>">
                            </div> 
                        </div>                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $translate->__('Cancel');?></button>
                            <button type="submit" class="btn btn-primary"><?php echo $translate->__('Add an email');?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--ADD EMAIL MODAL END-->

        <!--EMAIL SEARCH MODAL-->
          <div id="emailSearch" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?php echo $translate->__('Select the user');?></h4>
                    </div>
                        <div class="modal-body">
                            <select class="selectpicker form-control" data-live-search="true" data-style="btn-info" size="18" id="userMail" style="font-size: 14px;padding-bottom: 20px">
                                <?php
                                    Foreach($mail->userMailList as $UserMail){
                                    echo '<option value="'.$UserMail['USERID'].'">'.$UserMail['USERNAME'].'</option>';
                                } ?>
                            </select>
                            <table id="jsontable" class="table table-striped table-bordered">
                            <p></p>
                            <thead>
                                <tr>
                                    <th>PROCESSLABEL</th>
                                </tr>
                            </thead>
                        </table>                     
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $translate->__('Close');?></button>
                        </div>
                </div>
            </div>
        </div>
        <!--EMAIL SEARCH MODAL END-->
  <script>

    $('#formEnvironment').on('change', function(e){
        $("#wait").css("display", "block");
        $('#formEnvironment').attr('disabled',true);
        $('#formEnvironment').selectpicker('refresh');
        $('#formProcess').attr('disabled',true);
        $('#formProcess').selectpicker('refresh');
        $('#addProcessBtn').attr('disabled',true);
        $('#addProcessBtn').selectpicker('refresh');
        $('#addEmailBtn').attr('disabled',true);
        $('#addEmailBtn').selectpicker('refresh');
        $('#emailSearchBtn').attr('disabled',true);
        $('#emailSearchBtn').selectpicker('refresh');

        $("#mailingListform :input").prop("disabled", true);
    });

    function myFunction() {
        document.form1.emailEmail.value = document.form1.emailFirstName.value + '.' + document.form1.emailName.value + '@loccitane.com';
    }

    $("#optionsRadios1").click(function() {
      $("#emailEmail").prop("disabled", true);
       document.form1.emailEmail.value = document.form1.emailFirstName.value + '.' + document.form1.emailName.value + '@loccitane.com';
      });
    $("#optionsRadios2").click(function() {$("#emailEmail").prop("disabled", false);});
           
    var mailList1 = $('select[name="mailingList[]"]').bootstrapDualListbox({
        filterTextClear: '<?php echo $translate->__('Show all');?>',
        nonSelectedListLabel: '<?php echo $translate->__('Non selected');?>',
        selectedListLabel: '<?php echo $translate->__('Selected');?>',
        moveSelectedLabel: '<?php echo $translate->__('Move selected');?>',
        moveAllLabel: '<?php echo $translate->__('Move all');?>',
        removeSelectedLabel: '<?php echo $translate->__('Remove selected');?>',
        removeAllLabel: '<?php echo $translate->__('Remove all');?>',
        infoTextFiltered: '<span class="label label-warning"><?php echo $translate->__('Filtered');?></span> {0} <?php echo $translate->__('from');?> {1}',
        filterPlaceHolder: '<?php echo $translate->__('Filter');?>',
        infoText: '<span class="label label-primary"><?php echo $translate->__('Showing all');?></span> {0}',
        infoTextEmpty: '<?php echo $translate->__('Empty list');?>',
        moveOnSelect: false,
    });

    $("#mailingListform").submit(function() {
      var mailList = $('[name="mailingList[]"]').val();
      var process = $('#formProcess').find("option:selected").val();
        $.ajax({
            type: 'POST',
            url: '../model/update_MailingList.php',
            data: {process:process,mailList:mailList},
            success: function(data){               
            }
        }); 
    });

    $('#formProcess').on('change', function(e){
      $("#wait").css("display", "block");
      $("#arearesults").empty();
      mailList1.bootstrapDualListbox('refresh', true);
          e.preventDefault();
        var selected = $(this).find("option:selected").val();
        $.ajax({
                type: 'POST',
                url: '../model/getUserMail.php',
                data: {process:selected},
                dataType: "json",
                success: function(data){      
                    $.each(data.selected, function (key, value) {
                            $("#arearesults").append(
                                $("<option selected='selected'></option>").attr(
                                    "value", value.USERID).text(value.USERNAME)
                            );
                     });
                     $.each(data.unselected, function (key, value) {
                            $("#arearesults").append(
                                $("<option></option>").attr(
                                    "value", value.USERID).text(value.USERNAME)
                            );
                     });
                mailList1.bootstrapDualListbox('refresh', true);
                $("#wait").css("display", "none");
                }
        });
    });
    $("#myAlert").fadeToggle(3000);
      
    $('#jsontable').on('click', 'tr', function () {
        $(this).toggleClass('info');
    } );

        $("#userMail").on('change', function(e){
                event.preventDefault();
                var userid = $.trim($("#userMail").val());
                var oTable = $('#jsontable').DataTable({
                    destroy: true,
                    "sDom":"<'row'<'col-xs-3'l>r>"+"t"+"<'row'<'col-xs-6'i><'col-xs-6'p>>",
                    "oTableTools": {
                                    aButtons:     ['print'],
                                    sSwfPath: "../css/plugins/TableTools/swf/copy_csv_xls_pdf.swf"
                    },
                    "language": {
                        "url": "../js/plugins/dataTables/locale/<?php echo $_SESSION['lang']?>.txt"
                    },
                    "ajax": "../model/getProcessMailPerUser.php?userid=" + userid,
                    "error": "Cannot delete. Must delete ... first",
                    "aoColumns": [
                                    { "mData": "PROCESSLABEL" },
                                ],
                        });
                }); 
  </script>

<?php  include '../partials/footer.php'; ?> 