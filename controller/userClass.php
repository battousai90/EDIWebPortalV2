<?php
require_once DOCUMENT_ROOT.('/lib/db.php');

class User
{
	var $table = "T_USER_USR";
	public $id;
	public $login;
	public $firstName;
	public $name;
	public $mail;
	public $language;
	public $timeZone;
	public $envDefault;
	public $environment;
	
	public function __construct(){					
	}

	public function getUser($user)
	{
		try{
			$db = new DB(25);    
			$stmt = $db->prepare('
			    SELECT *
			    FROM ZUSER
			    WHERE ZUSER.USERLOGIN = ?
			');
			$stmt->execute(array($user));				
			while ($row = $stmt->fetch (PDO::FETCH_ASSOC)){
				$this->id = $row["USERID"];
				$this->login = $row['USERLOGIN'];
				$username = explode(' ',$row['USERNAME']);
				$this->firstName = $username[0];
				$this->name = $username[1];
				$this->mail = $row['USERMAIL'];
				$this->language = $row['USERLANGUAGE'];
				$this->timeZone = $row['USERTIMEDELAY'];
				$this->envDefault = $row['USERENVDEFAULT'];			
			}	
	   }
		catch(PDOException $e)
       {
           echo $e->getMessage();
		   die("Oh noes! There's an error in the query!");
       }
	   $this->environment = $this->getUserEnv();		
	}
	
	public function getUserEnv(){
		$db = new DB(25);
		$stmt = $db->prepare('
		    SELECT ZENVIRONMENT.ENVNAME, ZENVIRONMENT.ENVID, ZUSERENVIRONMENT.USERID,ZENVIRONMENT.ENVCONNECTION
		    FROM ZENVIRONMENT
		    LEFT OUTER JOIN ZUSERENVIRONMENT
		    ON ZENVIRONMENT.ENVID = ZUSERENVIRONMENT.ENVID
		    AND ZUSERENVIRONMENT.USERID = ZUSERENVIRONMENT.USERID
		    LEFT OUTER JOIN ZUSER
		    ON ZUSERENVIRONMENT.USERID = ZUSER.USERID
		    WHERE ZUSER.USERID = ?
		    ORDER BY ZENVIRONMENT.ENVNAME
		');
		$stmt->execute(array($this->id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$series1 = array();
		
		Foreach($result as $r) {
		        $serie1['ENVNAME']=$r['ENVNAME'];
		        $serie1['ENVID']=$r['ENVID'];
		        $serie1['ENVCONNECTION']=$r['ENVCONNECTION'];
		        array_push($series1,$serie1);
		}
			return $series1;        
    }
	
}
?>