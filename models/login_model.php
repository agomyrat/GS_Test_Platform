<?php

Class Login_Model extends Model{
    public function __construct(){	
		parent::__construct();
	}	

    public function check($user,$column){
        $sql = "SELECT COUNT(*) FROM users WHERE $column = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$user]);
        return $query->fetch()[0];
    }
}

?>