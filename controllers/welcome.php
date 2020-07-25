<?php 

class Welcome extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "welcome";	
	}

	public function index(){
		$this->view->render('welcome/index');
	}
	
	public function mailNotification(){
		$this->view->render('welcome/mailnotification');
	}

	public function activateUser($verificationCodeArray = null){
    	$user_id = isset($verificationCode) ? $this->model->activateUser($verificationCodeArray[0]) : null;
		if(isset($user_id)){
			echo "hemme zat gul yaly tamamlandy huh<br>";
       	 	Session::set(USER_ID,$user_id);
        	$this->redirect();
		}else{
			echo "__user ID alnyp bilmedi__";
			$this->error();
		}     
    }

	public function setNewPassword($verificationCodeArray = []){
		$verificationCode = $verificationCodeArray[0];

	}
}

 ?>