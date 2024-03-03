<?php
/*include '../lib/includes.php';

// On interroge la BDD pour récupérer la liste de tous les email disponibles
$query = "SELECT * FROM T_USER_USR";

$db = new DB();
$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$series = array();

Foreach($result as $r) {
        $serie['USERLOGIN']=$r['USR_LOGIN'];
        $serie['USERMAIL']=$r['USR_MAIL'];
        $serie['USERID']=$r['USR_ID'];
        $serie['USERNAME']=$r['USR_NAME'];
        $serie['USERENVDEFAULT']=$r['USR_ENV_DEFAULT'];
        $serie['USERLANGUAGE']=$r['USR_LANG'];
        $serie['USERTIMEDELAY']=$r['USR_TIME'];
        array_push($series,$serie);
}
$results = array();
$results['data']=$series;

echo json_encode($results);*/
include '../lib/includes.php';
$Users = Model::load("Users");
$usrs = $Users->find(array());

if (isset($_GET['userID'])){
	$id = $_GET['userID'];
	$usrs = $Users->find(array(
		"conditions"=>"id = $id"));
}
$series = array();

Foreach($usrs as $r) {
		$serie['id']=$r['id'];
        $serie['USERLOGIN']=$r['USR_LOGIN'];
        $serie['USERMAIL']=$r['USR_MAIL'];
        $serie['USERNAME']=$r['USR_NAME'];
        $serie['USERENVDEFAULT']=$r['USR_ENV_DEFAULT'];
        $serie['USERLANGUAGE']=$r['USR_LANG'];
        $serie['USERTIMEDELAY']=$r['USR_TIME'];
        array_push($series,$serie);
}

$results = array();
$results['data']=$series;

echo json_encode($results);
?>


