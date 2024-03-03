<?php
include '../lib/includes.php';

// On interroge la BDD pour récupérer la liste de tous les email disponibles
$query = "SELECT ZUSER.USERMAIL,ZUSER.USERID,ZUSER.USERNAME FROM ZUSER WHERE ZUSER.USERMAIL IS NOT NULL ORDER BY ZUSER.USERNAME";

$db = new DB($_SESSION['environmentID']);
$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$series = array();

Foreach($result as $r) {
        $serie['USERMAIL']=$r['USERMAIL'];
        $serie['USERID']=$r['USERID'];
        $serie['USERNAME']=$r['USERNAME'];
        array_push($series,$serie);
}

echo json_encode($series,JSON_NUMERIC_CHECK);
?>


