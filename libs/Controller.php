<?php 

	class Controller {
		function __construct(){
			// "Main controller<br>";
			$this->view = new View();

			if(!isset($_COOKIE[USER_ID])){
				// header("Location: ".URL."welcome/index");
			}
		}

		public function loadModel($name){
			$path = 'models/'.$name.'_model.php';

			if(file_exists($path)){
				require 'models/'.$name.'_model.php';

				$modelName = $name.'_Model';
				$this->model = new $modelName();
			}else{}
		}

		public function error(){
			$this->view->layout='welcome';
			$this->view->render('not_found/index');
		}

		public function getUserId(){
			return Session::has(USER_ID) ? Session::get(USER_ID) : Cookie::get(USER_ID);
		}

		public function redirect($address = ""){
			header("Location: ".URL.$address);
		}

		public function incrementErrorTrial(){
			$old_trial_number = Session::has(ERROR_TRIAL) ? Session::get(ERROR_TRIAL) : 0;
			$new_trial_number = $old_trial_number++;
			Session::set(ERROR_TRIAL,$new_trial_number);
		}

		public function changeLanguage(){
			Polyglot::changeLanguage();
		}


	}
	
 ?>