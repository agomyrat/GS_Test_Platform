<?php 

class Welcome extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "welcome";	
	}

	public function index(){
		Polyglot::setPage('welcome');
		$this->view->render('welcome/index');
	}

	public function activateUser($verificationCodeArray = null){
    	$user_id = isset($verificationCodeArray) ? User::_activateUser($verificationCodeArray[0]) : null;
		Session::set(USER_ID,$user_id);	
		isset($user_id) ? $this->redirect('main') : $this->error();      
    }

	public function setNewPassword($verificationCodeArray = []){
		$verificationCode = $verificationCodeArray[0];
	}

	public function test(){
		$tests = $this->user->getTests();
		echo '<pre>';
		var_dump($tests);
	}


	/*public function test(){
		$variable = User_model::get();
	}*/

}

 ?>