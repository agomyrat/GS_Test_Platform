<?php 

    class Profile extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = 'main';
        }

        public function index(){
            Polyglot::setPage('profile');
            $this->view->render('profile/index');
        }

        public function myProfile(){
            echo 'post';
            print_r($_POST);
            echo 'files';
            print_r($_FILES);
        }
    }




?>