<?php 
	
	class Controller {
		function __construct(){
			// "Main controller<br>";
			$this->view = new View();

			if(!isset($_COOKIE[USER_ID])){
				// header("Location: ".URL."welcome/index");
			}
		}

		public function createUser($id){
			$this->user = new User($id);
		}

		public function error(){
			Polyglot::setPage('not_found');
			$this->view->layout='logo';
			$this->view->render('not_found/index');
		}

		public function getUserId(){
			return Session::has(USER_ID) ? Session::get(USER_ID) : Cookie::get(USER_ID);
		}

		public function redirect($address = ""){
			echo "<script>window.location.href = '".URL.$address."'</script>";
		}

		public function incrementErrorTrial(){
			$old_trial_number = Session::has(ERROR_TRIAL) ? Session::get(ERROR_TRIAL) : 0;
			$new_trial_number = $old_trial_number++;
			Session::set(ERROR_TRIAL,$new_trial_number);
		}

		public function changeLanguage(){
			Polyglot::changeLanguage();
		}

		public function sendMail($address,$elementsArray){
			$elementsArray['html'] = View::getHtmlTemplate($elementsArray['templateName'],['link'=>$elementsArray['link']]);
			$elementsArray['text'] = View::getTextTemplate($elementsArray['templateName'],['link'=>$elementsArray['link']]);
			require "libs/Mail.php";
			sendMail($address,$elementsArray);
		}
			

	}
	
 ?>