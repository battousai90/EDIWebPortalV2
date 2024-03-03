<?php
include '../lib/includes.php';
$userid = $_GET['userid'];

// On interroge la BDD pour récupérer la liste de tous les email disponibles
$query = "SELECT ZPROCESSMAILING.PROCESSLABEL
FROM MAILING_LIST
Join ZPROCESSMAILING
ON MAILING_LIST.PNAME = ZPROCESSMAILING.PROCESSNAME
Join ZUSER
ON MAILING_LIST.USER_ID = ZUSER.USERID
WHERE MAILING_LIST.USER_ID = '".$userid."'
Group By ZPROCESSMAILING.PROCESSLABEL";
try{
$db = new DB($_SESSION['environmentID']);
$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Oh noes! There's an error in the query!");
}
$series = array();

Foreach($result as $r) {
        $serie['PROCESSLABEL']=$r['PROCESSLABEL'];
        array_push($series,$serie);
}
$results = array();
$results['data']=$series;

echo json_encode($results,JSON_NUMERIC_CHECK);
?>


