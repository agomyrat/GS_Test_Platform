<?php 

    class Question_model extends Model{

        public $id;

        public $test_id;

        // TODO: israndom backendinki
        public $is_random;//1-yes, 0-no

        public $type; //enum

        public $data; 
        
        public function __construct(){
            parent::__construct();
        }

      

        $q1 = new Question_model();
        $Question::inst(id=1)->update();
      
Querstion_model()->delete(1)



       
    }
?>