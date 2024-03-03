<?php
require_once ('../lib/includes.php');
if (!isset($_SESSION)) {
    session_start();
}
$process = explode('#',$_POST['process']);
$maiList = $_POST['mailList'];
$maiListString = implode(",", $maiList);
$integerIDs = array_map('intval', explode(',', $maiListString));

//---------------------DELETE des mails supprimés de la liste----------------------------------------
if(implode(",", $maiList) == ''){
    if ($process[1]!=''){
        $query= "   DELETE
                    FROM MAILING_LIST
                    WHERE PNAME = '".$process[0]."'
                    AND MAILING_LIST.COUNTRY_CODE = '".$process[1]."'               
                    ";
    }
    else{
        $query= "   DELETE
                    FROM MAILING_LIST
                    WHERE PNAME = '".$process[0]."'
                    ";
    }
}
else{
    if ($process[1]!=''){
        $query= "   DELETE
                    FROM MAILING_LIST
                    WHERE MAILING_LIST.USER_ID NOT IN (".implode(",", $maiList).")
                    AND PNAME = '".$process[0]."'
                    AND MAILING_LIST.COUNTRY_CODE = '".$process[1]."'               
                    ";
    }
    else{
        $query= "   DELETE
                    FROM MAILING_LIST
                    WHERE MAILING_LIST.USER_ID NOT IN (".implode(",", $maiList).")
                    AND PNAME = '".$process[0]."'
                    ";
    }
}
$db = new DB($_SESSION['environmentID']);
$stmt = $db->prepare($query);
$stmt->execute();

//---------------------INSERT des mails ajoutés de la liste----------------------------------------
foreach($integerIDs as $v) {
    if ($process[1]!=''){
        $query2= "  IF (SELECT COUNT(*)
	                FROM MAILING_LIST
	                JOIN ZPROCESSMAILING
	                ON MAILING_LIST.PNAME = ZPROCESSMAILING.PROCESSNAME
	                WHERE USER_ID = '".$v."'
                    AND ZPROCESSMAILING.PROCESSNAME = '".$process[0]."'
                    AND MAILING_LIST.COUNTRY_CODE = '".$process[1]."') = 0
                    INSERT INTO MAILING_LIST(USER_ID, PNAME,SALE_ORG,COUNTRY_CODE)
                    VALUES ('".$v."','".$process[0]."',NULL,'".$process[1]."');
                    ";
    }
    else{
        $query2= "  IF (SELECT COUNT(*)
	                FROM MAILING_LIST
	                JOIN ZPROCESSMAILING
	                ON MAILING_LIST.PNAME = ZPROCESSMAILING.PROCESSNAME
	                WHERE USER_ID = '".$v."' AND
	                ZPROCESSMAILING.PROCESSNAME = '".$process[0]."') = 0
                    INSERT INTO MAILING_LIST(USER_ID, PNAME,SALE_ORG,COUNTRY_CODE)
                    VALUES ('".$v."','".$process[0]."',NULL,NULL);
                    ";
    }
    $db2 = new DB($_SESSION['environmentID']);
    $stmt2 = $db2->prepare($query2);
    $stmt2->execute();
}
//----------------------------------------------------------------------------------------------------

$_SESSION['flash']['success'] = 'Mailing list was successfully updated';
header('location: /views/mailingList.php');
?>
