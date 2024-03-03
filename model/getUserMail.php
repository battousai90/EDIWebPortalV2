<?php
include '../lib/includes.php';
$process = explode('#',$_POST['process']);
// Détection si le flux possède un PAYS
if ($process[1]!=''){
    $query= "   SELECT ZUSER.USERMAIL,ZUSER.USERID,ZUSER.USERNAME
                FROM MAILING_LIST
                JOIN ZUSER
                ON MAILING_LIST.USER_ID = ZUSER.USERID
                WHERE MAILING_LIST.PNAME = '".$process[0]."' AND MAILING_LIST.COUNTRY_CODE ='".$process[1]."'";
}
else{
    $query= "   SELECT ZUSER.USERMAIL,ZUSER.USERID,ZUSER.USERNAME
                FROM MAILING_LIST
                JOIN ZUSER
                ON MAILING_LIST.USER_ID = ZUSER.USERID
                WHERE MAILING_LIST.PNAME = '".$process[0]."'";
}
// On récupère tous les mail déja selectionné pour un flux
try{
$db = new DB($_SESSION['environmentID']);
$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (Exception $e) {
    die("Oh noes! There's an error in the query!");
}
$series1 = array();

Foreach($result as $r) {
        $serie1['USERMAIL']=$r['USERMAIL'];
        $serie1['USERID']=$r['USERID'];
        $serie1['USERNAME']=$r['USERNAME'];
        array_push($series1,$serie1);
}
// On interroge la BDD pour récupérer la liste de tous les email disponibles
$query2 = "SELECT ZUSER.USERMAIL,ZUSER.USERID,ZUSER.USERNAME FROM ZUSER WHERE ZUSER.USERMAIL IS NOT NULL ORDER BY ZUSER.USERNAME";
try{
$db2 = new DB($_SESSION['environmentID']);
$stmt2 = $db2->prepare($query2);

$stmt2->execute();
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}
catch (Exception $e) {
    die("Oh noes! There's an error in the query!");
}
$series2 = array();

Foreach($result2 as $r2) {
        $serie2['USERMAIL']=$r2['USERMAIL'];
        $serie2['USERID']=$r2['USERID'];
        $serie2['USERNAME']=$r2['USERNAME'];
        array_push($series2,$serie2);
}

$filteredSeries2 = array_filter($series2, function ($element) use ($series1) {
    return !in_array($element, $series1);
});
//On compare les deux liste selected et unselected pour supprimer les doublons
$final = array('selected' => $series1,'unselected' => $filteredSeries2);

echo json_encode($final,JSON_NUMERIC_CHECK);
?>

