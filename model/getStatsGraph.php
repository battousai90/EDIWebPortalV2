<?php
include '../lib/includes.php';
require_once DOCUMENT_ROOT.'/locale/translator.php';
if (!isset($_SESSION)) {
    session_start();
}

$translate = new Translator($_SESSION['lang']);

$category = array();
$category['name'] = $translate->__('Hour');


$serie1 = array();
$serie1['name'] = $translate->__('Successful flows');

$serie2 = array();
$serie2['name'] = $translate->__('Error flows');
   
$db = new DB($_SESSION['environmentID']);
$stmt = $db->prepare("
    SELECT datepart(hour,HSTART) as HOUR, COUNT(CASE WHEN HSTATUS > 0 AND HNAME not like '%ZEBRA%' AND HSTART > CONVERT(date,GETDATE(),110) THEN HNAME END) as NB
    FROM HISTO
        WHERE HSTART IS NOT NULL
    GROUP BY datepart(hour,HSTART)
    ORDER BY  datepart(hour,HSTART)
");

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

Foreach($result as $r) {
        $category['data'][]=$r['HOUR'];
        $serie1['data'][]=$r['NB'];
}

$db2 = new DB($_SESSION['environmentID']);
$stmt2 = $db2->prepare("
    SELECT datepart(hour,HSTART) as HOUR, COUNT(CASE WHEN HSTATUS < 0 AND HNAME not like '%ZEBRA%' AND HSTART > CONVERT(date,GETDATE(),110) THEN HNAME END) as NB
    FROM HISTO
        WHERE HSTART IS NOT NULL
    GROUP BY datepart(hour,HSTART)
    ORDER BY  datepart(hour,HSTART)
");

$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

Foreach($result2 as $r) {
        $serie2['data'][]=$r['NB'];
}

$results = array();

array_push($results,$category);
array_push($results,$serie1);
array_push($results,$serie2);

echo json_encode($results,JSON_NUMERIC_CHECK);
?>