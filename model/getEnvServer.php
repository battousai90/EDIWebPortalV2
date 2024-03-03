<?php
include '../lib/includes.php';

$db = new DB();
$stmt = $db->prepare('
                        SELECT  ENVID,
                                ENVNAME,
                                ENVCONNECTION,
                                ENVBACKUP,
                                ENVBROKERIP,
                                ENVBROKERPORT
                        FROM ZENVIRONMENT
                        WHERE ENVID = ?
');
$stmt->execute(array($_GET['userid']));
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$series1 = array();

Foreach($result as $r) {
        $serie1['ENVID']=$r['ENVID'];
        $serie1['ENVNAME']=$r['ENVNAME'];
        $serie1['ENVCONNECTION']=$r['ENVCONNECTION'];
        $serie1['ENVBACKUP']=$r['ENVBACKUP'];
        $serie1['ENVBROKERIP']=$r['ENVBROKERIP'];
        $serie1['ENVBROKERPORT']=$r['ENVBROKERPORT'];
        array_push($series1,$serie1);
}

echo json_encode($series1, JSON_NUMERIC_CHECK);
?>
