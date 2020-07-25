<?php 

    class Welcome_model extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function activateUser($verifyCode){
            //eger yalnysh verify code gelen bolsa
            //eger user databaseden pozulandan son shu funksiya yuz tutulsa
            //return etmeli zat barada pikirlenmeli
             $update_sql = "UPDATE users SET ACTIVE = 1 WHERE VERIFY_CODE = ?";
             $select_sql = 'SELECT USER_ID FROM users WHERE VERIFY_CODE = ?';

             $update_stmt = $this->db->prepare($update_sql);
             $select_query = $this->db->prepare($select_sql);

             $update_stmt->execute([$verifyCode]);
             $select_query->execute([$verifyCode]);

             return $select_query->fetch()[0];//eger user_id tapylmasa boljak zatlary pikirlenmeli
        }


    }
?>