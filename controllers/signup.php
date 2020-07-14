<?php 
/**
 * 
 */
class Signup extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        //$this->view->layout = "signup";	
	}

	public function index(){

		$this->view->render('signup','signup/index');
		}

	public function error(){
			$this->view->msg='There is no such method';
			$this->view->render('error/index');
		}

	public function run(){
		$this->model->run();
	}
}

 ?>