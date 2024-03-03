<?php
require_once ('../lib/includes.php');
session_start();
$db = new DB(25);
$req = $db->prepare("
        INSERT INTO ZUSER
           (USERLOGIN,USERLANGUAGE)
        VALUES
           (?,?)
           ");
$req->execute(array($_SESSION['user'],$_SESSION['lang']));
?>
