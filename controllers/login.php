<?php 

    class Login extends Controller{
        public function __construct(){
            parent::__construct();
            $this->view->layout = "login";
        }

        public function index(){
            $this->view->render('login/index');
        }

        public function checkLogin(){
            if(isset($_POST)){
                $user = $_POST['user'];
                $password = md5($_POST['password']);
                $remember = isset($_POST['remember']);

                $column = filter_var($user, FILTER_VALIDATE_EMAIL) ? 'E_MAIL' : 'USER_NAME';
                $this->model->check($user,$column) ? $hasPassword = $this->model->check($password,'PASSWORD') : $hasPassword = false;
                if($hasPassword){
                    if($remember){
                        $cryptography = new Cryptography();
                        $encrypted_user = $cryptography->encrypt($user);
                        setcookie(USER_ID, $encrypted_user, time() + (86400 * 30), "/");//1 ay uchin //cookie diylen classyn objecetlerini ulanyp etmeli
                         }

                    //if($user_is_active == 1){then allow him to login} else{go to page that says activate you account by confirming your mail}
                        Session::set(USER_ID,$user);
                        header("Location:".URL."main");
                     }else{
                        echo "Incorrect username/email or password";
                    }
            }
        }
    }




?>