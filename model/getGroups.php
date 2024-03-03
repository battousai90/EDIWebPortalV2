<?php
include '../lib/includes.php';
$Group = Model::load("Group");
$grp = $Group->find(array("order"=>"name ASC"));

if (isset($_GET['groupID'])){
	$id = $_GET['groupID'];
	$grp = $Group->find(array(
		"conditions"=>"id = $id"));
}
$series = array();

Foreach($grp as $r) {
        $serie['id']=$r['id'];
        $serie['name']=$r['name'];
        array_push($series,$serie);
}

$results = array();
$results['data']=$series;

echo json_encode($results);

?>


