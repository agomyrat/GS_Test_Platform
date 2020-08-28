<?php 

    class Login extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = "logo";
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

                if(User::_has($user,$column)){
                    if(User::_has($password,'PASSWORD')){
                        $hasPassword = true;
                    }
                }
                
                $user_id = User::_getUserId($column , $user);
                $isActive = User::_isActive($user_id);
               
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