<?php
require_once ('../lib/includes.php');
session_start();
$db = new DB($_SESSION['environmentID']);
$req = $db->prepare("
        INSERT INTO ZPROCESSMAILING
           (PROCESSNAME,PROCESSLABEL,PROCESSCOUNTRY)
        VALUES
           (?,?,?)
           ");
$req->execute(array($_POST['processName'],$_POST['processLabel'],$_POST['processCountry']));
$_SESSION['flash']['success'] = 'Process added with success';
header('location: /views/mailingList.php');
?>
