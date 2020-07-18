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
                $hasPassword = false;

                $column = filter_var($user, FILTER_VALIDATE_EMAIL) ? 'E_MAIL' : 'USER_NAME';
                //$this->model->check($user,$column) ? $hasPassword = $this->model->check($password,'PASSWORD') : $hasPassword = false;
                var_dump($this->model->check($user,$column));
                echo "<br>";
                if($this->model->check($user,$column)){
                    echo "before checking password: ";
                    var_dump($hasPassword);
                    echo "<br>";
                    //$hasPassword = $this->model->check($password,'PASSWORD');
                    if($this->model->check($password,'PASSWORD')){
                        $hasPassword = true;
                    }
                    echo "after checking password: ";
                    var_dump($hasPassword);
                }
                
               
                if($hasPassword){
                    if($remember){
                        $cryptography = new Cryptography();
                        $encrypted_user = $cryptography->encrypt($user);
                        setcookie(USER_ID, $encrypted_user, time() + (86400 * 30), "/");//1 ay uchin //cookie diylen classyn objectlerini ulanyp etmeli
                         }
                         $user_id = $this->model->getUserId($user, $column);
                    //if($user_is_active == 1){then allow him to login} else{go to page that says activate you account by confirming your mail}
                        Session::set(USER_ID,$user_id);
                        header("Location:".URL."main");
                     }else{
                        echo "Incorrect username/email or password";
                    }
            }
        }
    }




?>