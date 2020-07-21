<?php

Class Login_Model extends Model{
    public function __construct(){	
		parent::__construct();
	}	

    public function check($user,$column){
        $sql = "SELECT COUNT(*) FROM users WHERE $column = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$user]);
        return (bool) $query->fetch()[0];
    }

     public function getUsername($user_id){
            $sql = 'SELECT USER_NAME FROM users WHERE USER_ID = ?';
            $query = $this->db->prepare($sql);
            $query->execute([$user_id]);
            return $query->fetch()[0];
    }

     public function getUserId($user , $column){
            $sql = "SELECT USER_ID FROM users WHERE ".$column." = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$user]);
            return $query->fetch()[0];
    }

    public function getUserActive($user , $column){
            $sql = "SELECT ACTIVE FROM users WHERE ".$column." = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$user]);
            return (bool) $query->fetch()[0];
    }
}

?>