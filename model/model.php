<?php
Class Model{

	public $table;
	public $id;


	public function read($fields = null){
		if($fields == null){$fields = "*";}
		$query = "SELECT $fields FROM ".$this->table." WHERE id=".$this->id;
		$db = new DB();
		$stmt = $db->prepare($query);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		foreach($data as $k=>$v){
			$this->$k = $v;
		}
	}

	public function save($data){
		if(isset($data['id']) && !empty($data['id'])){
			$query = "UPDATE ".$this->table." SET ";
			foreach ($data as $k => $v) {
				if($k!="id"){
					$query .="$k='$v',";
				}				
			}
			$query = substr($query,0,-1);
			$query .= " WHERE id=".$data["id"];
		}
		else{
			$query = "INSERT INTO ".$this->table."(";
			unset($data['id']);
			foreach ($data as $k => $v) {
					$query .="$k,";				
			}
			$query = substr($query,0,-1);
			$query .=") VALUES (";
			foreach ($data as $v) {
				$query .="'$v',";				
			}
			$query = substr($query,0,-1);
			$query .= ")";
		}
		$db = new DB();
		$stmt = $db->prepare($query);
		echo $query;
		//$stmt->execute();
		$_SESSION['flash']['success'] = 'Your information was successfully updated';
	}

	public function delete($id=null){
		if($id==null){ $id = $this->id;}
		$query = "DELETE FROM ".$this->table." WHERE id=$id";
		$db = new DB();
		$stmt = $db->prepare($query);
		$stmt->execute();

	}

	Public function find($data=array()){
		$conditions = "1=1";
		$fields = "*";
		$limit = "";
		$order = "id DESC";
		if(isset($data["conditions"])){ $conditions = $data["conditions"];}
		if(isset($data["fields"])){ $fields = $data["fields"];}
		if(isset($data["limit"])){ $limit = "TOP ".$data["limit"];}
		if(isset($data["order"])){ $order = $data["order"];}

		$query = "SELECT $limit $fields FROM ".$this->table." WHERE $conditions ORDER BY $order";
		$db = new DB();
		$stmt = $db->prepare($query);
		$stmt->execute();
		$d = array();
		while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
			$d[]=$data;
		}
		return $d;		
	}

	static function load($name){
		require("$name.php");
		return new $name();
	}
	
}
?>
