<?php 
	class Bootstrap {
		function __construct(){
		
		Session::init();
		$this->url = $this->getUrl();

		if(Session::has(USER_ID) || Cookie::has(USER_ID)){
			if($this->url){
				$this->runURL($this->url);
				return;
			}
			$this->goToPage('main');
			return;

		}else if($this->url[0] == 'signup' || $this->url[0] == 'login' || $this->url[0] == 'welcome'){
			$this->runURL($this->url);
			return;
		}

		$this->goToPage('welcome');	
	}



	//------------------------------get methods---------------------------

	private function getUrl(){
		return isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/') ) : false;
	}

	private function getParameters($array = null, $index = 2){
		$parametersArray = [];
		$parametersArray_index = 0;

		while(isset($array[$index])){
			$parametersArray[$parametersArray_index] = $array[$index];
			$parametersArray_index++;
			$index++;
		}
		return $parametersArray;
	}

	private function selectController($controllerName){
			$file = 'controllers/'.$controllerName.'.php';
			if(file_exists($file)){
				require $file;
				$controller = new $controllerName;
				$controller->loadModel($controllerName);
			}else{
				require 'controllers/error.php';
				$controller = new Error;
			}

			return $controller;
	}

	//--------------------run methods------------------------------------

	private function runMethod($methodName , $controllerName){	
			if(isset($methodName)){	
				if(method_exists($controllerName,$methodName)){
					if($this->getParameters($this->url)!== null){
						$controllerName->{$methodName}($this->getParameters($this->url));
						return;
					}
					$controllerName->{$methodName}();
					return;
				}			
				$controllerName->error();
				return;
			}
			
			$controllerName->index();
	}

	private function runURL($urlArray){
		$controllerObject = $this->selectController($urlArray[0]);
		isset($urlArray[1]) ? $this->runMethod($urlArray[1],$controllerObject) : $controllerObject->index();
	}

	//---------------------------goTo methods-------------------------------

	private function goToPage($pageName){
		require 'controllers/'.$pageName.'.php';
		$controller = new $pageName;
		$controller->loadModel($pageName);
		$controller->index();
	}
	
}
?>