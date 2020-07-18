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

	public function error(){
		$this->view->msg='There is no such method';
		$this->view->render('error/index');
	}
	
	public function mailNotification(){
		$this->view->render('welcome/mailnotification');
	}

	public function activateUser($verificationCodeArray = [0]){
    	$user_id = $this->model->activateUser($verificationCodeArray[0]);
		if(isset($user_id)){
			echo "hemme zat gul yaly tamamlandy huh<br>";
       	 	Session::set(USER_ID,$user_id);
        	header("Location: ".URL);
		}else{
			echo "__user ID alnyp bilmedi__";
		}

       
    }
}

 ?>