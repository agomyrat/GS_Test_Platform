<?php 

    class Login extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = "login";
        }

        public function index(){
            Polyglot::setPage('login');
            $this->view->render('login/index');
        }

        public function checkLogin(){
            if(isset($_POST)){
                $user = $_POST['user'];
                $password = md5($_POST['password']);
                $remember = isset($_POST['remember']);
                $hasPassword = false;

                $column = filter_var($user, FILTER_VALIDATE_EMAIL) ? 'E_MAIL' : 'USER_NAME';
                $mailORuser = filter_var($user, FILTER_VALIDATE_EMAIL) ? 'Email' : 'Username';

                if($this->model->check($user,$column)){
                    if($this->model->check($password,'PASSWORD')){
                        $hasPassword = true;
                    }
                }
                
                $user_id = $this->model->getUserId($user , $column);
                $isActive = $this->model->getUserActive($user , $column);
               
                if($hasPassword){
                    if($isActive){
                        Session::set(USER_ID,$user_id);
                        if($remember){ 
                        Cookie::set(USER_ID,$user_id);}
                        echo 1;//goto main
                    }else{
                        echo 2;//goto mailnotification
                    }
    
                }else{
                   echo 0;//goto nowhere :-)
                }
            }
        }
    }




?>