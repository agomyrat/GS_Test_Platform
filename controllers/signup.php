<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer Composer's autoloader
require 'vendor/autoload.php';

class Signup extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "signup";	
	}

	public function index(){
		$this->view->render('signup/index');
	}

	public function error(){
		$this->view->msg='There is no such method';
		$this->view->render('error/index');
	}

	public function check_database_for_sign_up_input(){
		$this->model->check_database_for_sign_up_input();
	}

	
	public function registrate_user(){
		$mail = $this->model->registrate_user(); //registrate edilen userin mailini return edyar
		$verifyCode = $this->model->getVerifyCodeByMail($mail);//emaili berilen userin verifyCode return edyar

		$this->sendMail($mail,$verifyCode);
	}

	public function sendMail($mail,$verifyCode){
		echo $verifyCode;	
	}

	
}

 ?>