<?php 

    class Notfound extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = 'logo';
        }

        public function index(){
            $this->incrementErrorTrial();
            Polyglot::setPage('not_found');
            $this->view->render('not_found/index');
            
        }
    }




?>