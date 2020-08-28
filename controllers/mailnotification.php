<?php

    class Mailnotification extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        	$this->view->layout = "logo";
	}

	public function index(){
		Polyglot::setPage('mail_notification');
		$this->view->render('mail_notification/index');
	}

	public function notifyPassword($array=null){
		if(isset($_POST['mail'])){
			$mail = $_POST['mail'];
			$user_id = User::_getUserId('E_MAIL',$mail);
			if(!empty($user_id)){
				$data = User::_get($user_id,['E_MAIL','VERIFY_CODE']);
				$address = $data['E_MAIL'];
				$link = URL.'password/newpassword/'.$data['VERIFY_CODE'];

				$this->sendMail($address,['templateName'=>'register',
										  'link'=>$link,
										  'subject'=>'Link for new password!'
										  ]);

				Polyglot::setPage('mail_notification');
				$this->view->render('mail_notification/password');
			}else{
				echo "Bular mail bizin yazgylarymyzda yok! Belki sheyle bolup biler, beyle bolup biler...! Registrasiya bolun!";
			}
		}

		
	}

	public function notifyLogin(){
		//account activate edilmezden login boljak bolsa goyberilmeli page
	}

}