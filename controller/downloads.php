<?php
if(empty($_GET)) {
    header('Location: erreur.php');
}
$server = '10.0.1.86:8083';    
$username = 'LOIEU\dataexchanger';
$password = '3tbz6nzs';

$file_url = "http://".$username.':'.$password.'@'.$server.'/'.$_GET['folder'].'/'.$_GET['flow'].'/'.$_GET['date'].'/'.$_GET['file'];

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url);

?>