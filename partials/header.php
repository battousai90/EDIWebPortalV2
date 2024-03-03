<?php
require_once DOCUMENT_ROOT.('/lib/includes.php');
require_once DOCUMENT_ROOT.'/locale/translator.php';

if (!isset($_SESSION)) {
    session_start();
}

//$_SESSION['user']="LOIEU\gcoutot";
$_SESSION['user']=$_SERVER['AUTH_USER'];
//$_SESSION['user']=$_SERVER["LOGON_USER"];
$show_modal = false;
$_SESSION['lang']= "en_EN";
//var_dump($_SERVER);

$user =  new User();
$user->getUser($_SESSION['user']);

if($user->id == null){
    $show_modal = true;
    $_SESSION['lang']= "en_EN";
}
else{
$_SESSION['UserID'] = $user->id;
$_SESSION['lang']= $user->language;
}

if(!isset($_SESSION['environment'])){
    $_SESSION['environmentID'] = $user->envDefault;
    foreach($user->environment as $userEnv){
        if($userEnv['ENVID']==$_SESSION['environmentID']){
           $_SESSION['environment'] = $userEnv['ENVNAME'];
           $_SESSION['ENVCONNECTION'] = $userEnv['ENVCONNECTION'];   
        }   
    }
}
if (isset($_POST['formEnvironment'])){
    $_SESSION['environmentID'] = $_POST['formEnvironment'];
    foreach($user->environment as $userEnv){
        if($userEnv['ENVID']==$_POST['formEnvironment']){
           $_SESSION['environment'] = $userEnv['ENVNAME'];
           $_SESSION['ENVCONNECTION'] = $userEnv['ENVCONNECTION'];   
        }   
    }
}
if (isset($_POST['formEnvironment']) and $_SESSION['environmentID'] == $_POST['formEnvironment']){
    $current = $_SERVER['PHP_SELF'];   
    header("Location: $current");
}
$translate = new Translator($_SESSION['lang']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>EDI Web Portal V2</title>
    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/plugins/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">
    <link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../css/plugins/TableTools/dataTables.tableTools.css" rel="stylesheet">
    <link href="../css/flags.css" rel="stylesheet">
    <link href="../css/sidebartoggle.css" rel="stylesheet">
    <link href="../css/plugins/bootstrap-duallistbox.min.css" rel="stylesheet">
    <link href="../css/plugins/bootstrap-select.min.css" rel="stylesheet">

    <script type="text/javascript" src="../js/jquery.js"></script> 
    <script type="text/javascript" src="../js/Highcharts/highcharts.js" ></script>
    <script type="text/javascript" src="../js/Highcharts/modules/drilldown.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables/dataTables.tableTools.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="../js/Highcharts/modules/exporting.js"></script>
    <script type="text/javascript" src="../js/jquery.flagstrap.js"></script>
    <script type="text/javascript" src="../js/Sidebar-Toggle.js"></script>
    <script type="text/javascript" src="../js/plugins/jquery.bootstrap-duallistbox.min.js"></script>
    <script type="text/javascript" src="../js/plugins/bootstrap-select.min.js"></script>
  </head>
<body>
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; margin-left: 5px;">
        <div class="collapse col-xs-2 navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active" ><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle"> <span class="fa fa-bars fa-lg" aria-hidden="true"></span></button></li>
            </ul>
        </div>
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.php">EDI Web Portal</a>
        </div>
        <label class="col-xs-3 control-label"></label>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   <i class="fa fa-user fa-fw"></i><?php echo $translate->__('Welcome').' '.$_SESSION['user'].' '; ?><i class="fa fa-caret-down"></i>
                </a>
                <ul  class="dropdown-menu dropdown-user">    
                    <li><a href="<?php echo ROOT.'/views/profil.php';?>"><i class="fa fa-pencil-square-o"></i> <?php echo $translate->__('My profile');?></a></li>                        
                </ul>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" id="menu">                                       
                <li>
                    <a class="active" href="<?php $_SERVER['PHP_SELF']?>"><i class="fa fa-dashboard fa-fw"></i>&nbsp;<?php  echo $translate->__('IAE FLOW');?></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="../views/advancedSearch.php"><i class="fa fa-search fa-fw"></i>&nbsp;<?php echo $translate->__('Flow search');?></a>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i>&nbsp;<?php echo $translate->__('Flow management');?></a>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i>&nbsp;<?php echo $translate->__('Transco');?></a>
                            <a href="../views/mailingList.php"><i class="fa fa-envelope-o"></i>&nbsp;<?php echo $translate->__('Mailing list');?></a>

                        </li>
                    </ul>
                </li>
                <li>
                    <a class="active" href="#"><i class="fa fa-pie-chart fa-fw"></i>&nbsp;<?php echo $translate->__('KPI');?></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a target="_blank href="http://eumsqdex02:8082/index.php"><i class="fa fa-pie-chart fa-fw"></i>&nbsp;<?php echo $translate->__('IDOC');?></a>
                                <a href="#"><i class="fa fa-pie-chart fa-fw"></i>&nbsp;<?php echo $translate->__('DEX');?></a>
                            </li>
                        </ul>
                </li>
                <li>
                    <a class="active" href="#"><i class="fa fa-cogs fa-fw"></i>&nbsp;<?php echo $translate->__('ADMINISTRATION');?></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#"><i class="fa fa-signal fa-fw"></i>&nbsp;<?php echo $translate->__('Server Charge');?></a>
                            <a href="../views/groups.php"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo $translate->__('Groups');?></a>
                            <a href="../views/usersv.php"><i class="fa fa-users fa-fw"></i>&nbsp;<?php echo $translate->__('Users');?></a>
                            <a href="#"><i class="fa fa-filter fa-fw"></i>&nbsp;<?php echo $translate->__('Search filters');?></a>
                            <a href="#"><i class="fa fa-server fa-fw"></i>&nbsp;<?php echo $translate->__('Environments');?></a>
                            <a href="#"><i class="fa fa-newspaper-o fa-fw"></i>&nbsp;<?php echo $translate->__('Modification Logs');?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>                

<div id="page-wrapper">