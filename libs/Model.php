<?php

/**
*
*/
class Model
{
	public static $_db_ ;

	function __construct(){
		$this->db = new Database();
		$this->setDB();
	}
	
	public function setDB(){
		self::$_db_ = new Database();
	}

	public function hasOne($tableName , $assoc_array, $key_id){
		 foreach($assoc_array as $key=>$value){
			  try{
					$sql = "SELECT ".$value." FROM ".$tableName." WHERE (".$key." = ".$key_id.") LIMIT 1";
					$query = $this->db->prepare($sql);
					$query->execute([//':value'=>$value,
									//':tableName'=>$tableName,
									//':key'=>$key,
									//':key_id'=>$key_id
									]);
					if($query->rowCount() > 0){
						return $query->fetch(PDO::FETCH_ASSOC)[$value];
					}
	
				}catch(Exception $e){
					echo $e;
				}
		 }
	}

	public function hasMany($tableName , $assoc_array, $key_id){
		 foreach($assoc_array as $key=>$value){
			  try{
					$sql = "SELECT ".$value." FROM ".$tableName." WHERE (".$key." = ".$key_id.")";
					$query = $this->db->prepare($sql);
					$query->execute([//':value'=>$value,
									//':tableName'=>$tableName,
									//':key'=>$key,
									//':key_id'=>$key_id
									]);
						// echo 'tableName: '.$tableName;
						// echo 'key:'.$key;
						// echo 'value: '.$value;
						// echo 'key_id: '.$key_id;
						$result = $query->setFetchMode(PDO::FETCH_ASSOC);
						
						return $query->fetchAll();

				}catch(Exception $e){
					echo $e;
				}
		 }
	}
}

?>