<?php 

    class Notfound extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = 'icon_navbar';
        }

        public function index(){
            $this->incrementErrorTrial();
            $this->view->render('not_found/index');
            
        }
    }




?>