<?php 

    class Notfound extends Controller{
        public function __construct(){
            parent::__construct();
        }

        public function index(){
            $this->incrementErrorTrial();
            $this->view->render('error/notfound');
            
        }
    }




?>