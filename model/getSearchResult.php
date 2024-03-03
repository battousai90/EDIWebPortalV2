<?php
include '../lib/includes.php';

$db = new DB($_SESSION['environmentID']);
$stmt = $db->prepare("
SELECT	TOP 2000 MTRANS,
		MLIB,
		MDATA5,
		convert(varchar(20),MSUBMIT,20) as DATE,
		MDATA6,
		MDATA4,
		year(MSUBMIT) as YEAR,
		RIGHT('0' + RTRIM(MONTH(MSUBMIT)), 2) as MONTH
FROM HISTOM
WHERE MDATA5 like ? AND MLIB not like '%ORDERS%'
");
$stmt->execute(array('%'.$_GET['query'].'%'));
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$series1 = array();

Foreach($result as $r) {
        $serie1['MTRANS']=$r['MTRANS'];
        $serie1['MLIB']=$r['MLIB'];
        $serie1['MDATA5']=$r['MDATA5'];
        $serie1['DATE']=$r['DATE'];
        $serie1['MDATA6'] = $r['MDATA6'];
        $serie1['MDATA4']=$r['MDATA4'];
        $serie1['YEAR']=$r['YEAR'];
        $serie1['MONTH']=$r['MONTH'];
        array_push($series1,$serie1);
}

$results = array();
$results['data']=$series1;

echo json_encode($results);
?>
