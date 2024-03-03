<?php
require_once ('../lib/includes.php');
session_start();
$db = new DB(25);
$req = $db->prepare("UPDATE ZUSER SET USERLANGUAGE= ?, USERNAME= ?, USERMAIL= ?, USERTIMEDELAY= ? WHERE USERID = ?");
$req->execute(array($_POST['lang'],$_POST['firstname'].' '.$_POST['name'],$_POST['email'],$_POST['timeDelay'],$_SESSION['UserID']));
$_SESSION['flash']['success'] = 'Your information was successfully updated';
header('location: /views/profil.php');
?>

