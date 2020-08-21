<?php 

    class Main_model extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function getUsername($user_id){
            $sql = 'SELECT USER_NAME FROM users WHERE USER_ID = ?';
            $query = $this->db->prepare($sql);
            $query->execute([$user_id]);
            return $query->fetch()[0];
        }
    }
?>