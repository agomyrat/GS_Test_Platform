<?php

    class Password extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->view->layout = "logo";
    }
    
    public function index(){
        $this->forgotPassword();
    }

	public function forgotPassword(){
		Polyglot::setPage('forgot_password');
		$this->view->render('password/forgot');
    }
    
    public function newPassword($array=null){   
        $verify_code = isset($array[0]) ? $array[0] : 0;
        if(User::_has($verify_code,'VERIFY_CODE')){
            Polyglot::setPage('new_password');
		    $this->view->render('password/new',['verify_code'=>$verify_code]);
        }else{
            $this->error();
        }		
    }
    
    public function changePassword(){
        if(isset($_POST['verify_code'])){
            $verify_code = $_POST['verify_code'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $user_id = User::_getUserId('VERIFY_CODE',$verify_code);

            if($password == $confirm_password){
                User::_set($user_id,'PASSWORD',md5($password));
                echo 1;
            }else{
                echo 0;
            }
        }
    }

}