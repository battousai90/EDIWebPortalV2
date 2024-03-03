<?php
require_once DOCUMENT_ROOT.('/lib/db.php');

class Mail
{
	public $mailEnvProcessList;
	public $envProcessList;
	public $userMailList;

	
	public function __construct(){
	   $this->mailEnvProcessList = $this->getMailProcessPerEnvList();	
	   $this->envProcessList = $this->getProcessPerEnvList();
	   $this->userMailList = $this->getUserMailList();	
	}
	
	public function getMailProcessPerEnvList(){

		$db = new DB($_SESSION['environmentID']);
		$stmt = $db->prepare('
		                 SELECT PROCESSID,
		                        PROCESSNAME,
		                        PROCESSLABEL,
		                        PROCESSCOUNTRY
		                 FROM ZPROCESSMAILING
		                 ORDER BY PROCESSNAME
		');
		try{
			$test = $db->query('SELECT TOP 1 * FROM ZPROCESSMAILING');
		}
		catch (Exception $e) {
				return FALSE;
		}
		if ($test == FALSE) {
			$series1 = array();
			return $series1;
		}			
		else{
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$series1 = array();
			
			Foreach($result as $r) {
			        $serie1['PROCESSID']=$r['PROCESSID'];
			        $serie1['PROCESSNAME']=$r['PROCESSNAME'];
			        $serie1['PROCESSLABEL']=$r['PROCESSLABEL'];
			        $serie1['PROCESSCOUNTRY']=$r['PROCESSCOUNTRY'];
			        array_push($series1,$serie1);
			}
		
        return $series1;
		}
    }
	public function getProcessPerEnvList(){

			$db = new DB($_SESSION['environmentID']);
			$stmt = $db->prepare('
			                 SELECT PNAME
			                 FROM PROCESS
			                 ORDER BY PNAME
			');
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$series1 = array();
			
			Foreach($result as $r) {
			        $serie1['PNAME']=$r['PNAME'];
			        array_push($series1,$serie1);
			}
        return $series1;
    }
	public function getUserMailList(){
		$query = "SELECT ZUSER.USERMAIL,ZUSER.USERID,ZUSER.USERNAME FROM ZUSER WHERE ZUSER.USERMAIL IS NOT NULL ORDER BY ZUSER.USERNAME";

		$db = new DB($_SESSION['environmentID']);
		$stmt = $db->prepare($query);
		
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$series1 = array();
		
		Foreach($result as $r) {
		        $serie['USERMAIL']=$r['USERMAIL'];
		        $serie['USERID']=$r['USERID'];
		        $serie['USERNAME']=$r['USERNAME'];
		        array_push($series1,$serie);
		}
        return $series1;
    }
	
}
?>