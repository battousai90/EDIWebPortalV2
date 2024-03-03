<?php
require_once ('../lib/includes.php');
require_once DOCUMENT_ROOT.('/partials/header.php');
?>
<link href="../css/slideOutTab.css" rel="stylesheet">
<div class="row" style="padding-top: 10px">
    <div class="col-lg-12">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-exclamation-triangle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">10000</div>
                            <div>Over Limit</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="dom-target-untreated" class="huge">10000</div>
                                        <div>Untreated</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div id="dom-target-treated" class="huge">10000</div>
                                    <div>Treated</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-info fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">10000</div>
                                    <div>Total IDOCS</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                    </div>
                </div>
             </div>
            <!-- /.row -->
   </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
					    <div class="panel-heading">
						    Last 15 days History
					    </div>
					    <!-- /.panel-heading -->
					    <div class="panel-body">
						    <div id="chartsIndex" style="width:99%; height:350px;"></div>
					    </div>
					    <!-- /.panel-body -->
			        </div>
                </div>
            </div>

<script type="text/javascript">

</script>

<div id="slideout-default"><i class="fa fa-globe fa-lg"></i>
    <div id="slideout_inner-default">
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

<?php  include '../partials/footer.php'; ?> 