<?php
require_once ('../lib/includes.php');
session_start();
$_SESSION['flash']['success'] = 'E-mail has been sent to EDI Team successfully';

//add the recipient's address here
$myemail = 'edi@loccitane.com'; 
$message = strip_tags($_POST['comment']);
$name = $_SESSION['user'];

//generate email and send!
$to = $myemail;
$email_subject = "New EDI Webportal User";
$email_body = "You have received a new message. "." Here are the details:\n LOGIN: $name \n "."Comment : \n $message";
$headers = "From: EDI Webportal\n";

mail($to,$email_subject,$email_body,$headers);
?>