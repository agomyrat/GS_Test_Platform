<?php 

class Welcome extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "welcome";	
	}

	public function index(){
		$this->view->render('signup/index');
	}

	public function error(){
		$this->view->msg='There is no such method';
		$this->view->render('error/index');
	}
	
	public function mailNotification(){
		$this->view->render('welcome/mailnotification');
	}
}

 ?>