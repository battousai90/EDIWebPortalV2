<?php
require_once ('../lib/includes.php');
session_start();
$db = new DB($_SESSION['environmentID']);
$req = $db->prepare("
        INSERT INTO ZUSER
           (USERNAME,USERMAIL)
        VALUES
           (?,?)
           ");
$req->execute(array($_POST['emailFirstName'].' '.$_POST['emailName'],$_POST['emailEmail']));
$_SESSION['flash']['success'] = 'Email added with success'.$_POST['emailEmail'].' '.$_POST['emailName'].' '.$_POST['emailFirstName'];
header('location: /views/mailingList.php');
?>
