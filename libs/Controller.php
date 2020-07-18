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
			$this->view->render('error/notfound');
		}




	}
	
 ?>