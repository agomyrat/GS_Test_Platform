<?php 

    class Notfound extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = 'notfound';
        }

        public function index(){
            $this->incrementErrorTrial();
            $this->view->render('error/notfound');
            
        }
    }




?>