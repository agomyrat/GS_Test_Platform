<?php 

class Signup extends Controller
{
		
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "logo";
	}

	public function index(){
		Polyglot::setPage('signup');
		$this->view->render('signup/index');
	}

	public function check_for_input(){
		if(isset($_POST)){
			$column = $_POST['column'];
			$value = $_POST['value'];
			echo User::_has($value,$column);
		}
	}

	
	public function registrate_user(){ 
		if(!empty($_POST)){
			$user_id = User::_registrate($_POST); //registrate edilen userin idini return edyar
			$data = User::_get($user_id,['E_MAIL','VERIFY_CODE']);
			$address = $data['E_MAIL'];
			$link = URL."welcome/activateUser/".$data['VERIFY_CODE'];
			Polyglot::setPage('signup');
			$this->sendMail($address,['templateName'=>'register',
									  'link'=>$link,
									  'subject'=>Polyglot::translate('Registration letter')
									]);
		}
	}
	
}

 ?>