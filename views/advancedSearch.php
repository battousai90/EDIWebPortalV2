<?php
require_once ('../lib/includes.php');
require_once DOCUMENT_ROOT.('/partials/header.php');
?>
<link href="../css/slideOutTab.css" rel="stylesheet">
<div class="container" style="padding-top: 10px;">
    <form role="form" id="searchForm" action="#" method="post">
        <input type="hidden" name="action" value="add_form" /> 
        <div class="form-group has-feedback">
            <input class="form-control" placeholder="<?php echo $translate->__('Quick Search');?>" name="searchword" id="searchword">
            <i class="form-control-feedback fa fa-search"></i>
        </div><!-- /input-group -->
    </form>
</div>
<div class="container">
    <table id="jsontable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><?php echo $translate->__('Flows');?></th>
                <th><?php echo $translate->__('Reference values');?></th>
                <th><?php echo $translate->__('Date');?></th>
                <th><?php echo $translate->__('Status');?></th>
                <th><?php echo $translate->__('Filename');?></th>
                <th><?php echo $translate->__('Archive');?></th>
            </tr>
        </thead>
    </table>
</div>
 
<div id="slideout-default" style="top: 51px;"><i class="fa fa-globe fa-2x"></i>
    <div id="slideout_inner-default" style="top: 51px;">
        <label>Please select the domain</label>
        <form id="buttonGroupForm" method="post" class="form-horizontal">
            <div class="btn-group-vertical" style="margin-left: 15px" data-toggle="buttons">                
            <?php 
            Foreach($user->environment as $environment){
                echo ' <label class="btn btn-default">
                            <input type="radio" name="gender" value="'.$environment['ENVID'].'"/>'.$environment['ENVNAME'].'
                       </label>';
            } ?>       
            </div>
        </form>
    </div>
</div>
<div id="slideout-info" style="top: 102px;z-index: 3;"><i class="fa fa-calendar fa-2x"></i>
    <div id="slideout_inner-info" style="top: 102px;z-index: 3;">
        <label>Please select the domain</label>
        <form class="form-horizontal">
            <div class="form-group" style="margin-left: 15px">
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    General
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Central
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Brazil
                  </label>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="slideout-success" style="top: 153px;z-index: 4;"><i class="fa fa-calendar fa-2x"></i>
    <div id="slideout_inner-success" style="top: 153px;z-index: 4;">
        <label>Please select the domain</label>
        <form class="form-horizontal">
            <div class="form-group" style="margin-left: 15px">
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    General
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Central
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Brazil
                  </label>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="slideout-warning" style="top: 204px;z-index: 5;"><i class="fa fa-calendar fa-2x"></i>
    <div id="slideout_inner-warning" style="top: 204px;z-index: 5;">
        <label>Please select the domain</label>
        <form class="form-horizontal">
            <div class="form-group" style="margin-left: 15px">
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    General
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Central
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Brazil
                  </label>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="slideout-danger" style="top: 255px;z-index: 6;"><i class="fa fa-flag fa-2x"></i>
    <div id="slideout_inner-danger" style="top: 255px;z-index: 6;">
        <label>Please select the domain</label>
        <form class="form-horizontal">
            <div class="form-group" style="margin-left: 15px">
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    General
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Central
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                    Brazil
                  </label>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#jsontable').on('click', 'tr', function () {
        $(this).toggleClass('info');
    } );

    $("#searchword").keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            var searchWord = $.trim($("#searchword").val());
            var oTable = $('#jsontable').DataTable({
                destroy: true,
                "sDom":"<'row'<'col-xs-3'l><'col-xs-4'T><'col-xs-5'f>r>"+"t"+"<'row'<'col-xs-6'i><'col-xs-6'p>>",
                "oTableTools": {
                                aButtons:     ['print'],
                                sSwfPath: "../css/plugins/TableTools/swf/copy_csv_xls_pdf.swf"
                },
                "language": {
                    "url": "../js/plugins/dataTables/locale/<?php echo $_SESSION['lang']?>.txt"
                },
                "ajax": "../model/getSearchResult.php?query=" + searchWord,
                "error": "Cannot delete. Must delete ... first",
                "aoColumns": [
                                { "mData": "MLIB" },
                                { "mData": "MDATA5" },
                                { "mData": "DATE"},
                                { "mData": "MDATA6" },
                                { "mData": "MDATA4" }
                            ],
                "aoColumnDefs": [
                                    { "aTargets": [ 3 ],
                                    "mRender": function ( data, type, full ) {
                                     if(data == 'NO'){
                                         return '<span style="color:  #f00;"><i class="fa fa-times fa-lg"></i></span>';
                                    }else{
                                         return '<span style="color:  #279227;"><i class="fa fa-check fa-lg"></i></span>';
                                    }
                                }
                                },
                                {   "aTargets": [ 5 ],
                                    "mRender": function ( data, type, full ) {
                                         var MLIB = full.MLIB;
                                         var MTRANS = full.MTRANS;
                                         var MONTH = full.MONTH;
                                         var YEAR = full.YEAR;
                                         return '<a href="../controller/downloads.php?folder='+'<?php echo $_SESSION['ENVCONNECTION'] ?>'+'&flow='+MLIB+'&date='+YEAR+MONTH+'&file='+MTRANS+'.zip">'+'<i class="fa fa-file-archive-o fa-lg"></i>'+'</a>';
                                    }
                                }
                                ]

                    });
                    var tt = new $.fn.dataTable.TableTools( oTable );
                    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
                    $('#search-result').modal('show');
                }
            });
        </script>
<?php  include '../partials/footer.php'; ?> 
