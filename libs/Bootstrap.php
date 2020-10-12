<?php 
	class Bootstrap {
		function __construct(){
		Session::init();
		!Session::has(LANG) ? Session::set(LANG,'TM') : null;
		$this->url = $this->getUrl();
		// echo Session::get(USER_ID);
		// echo Cookie::get(USER_ID);
		// die;
		if(Session::isNumber(USER_ID) || Cookie::isNumber(USER_ID)){
			if(!Session::has(USER_ID)){Session::set(USER_ID,Cookie::get(USER_ID));}
			
			if($this->url){
				$this->runURL($this->url);
				return;
			}
			$this->goToPage('main');
			return;

		}else if(isset($this->url[0]) && $this->isAllowed()){
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
				if(Session::isNumber(USER_ID))
				{$controller->createUser(Session::get(USER_ID));}

			}else{
				require 'controllers/notfound.php';
				$controller = new Notfound;
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
		$controller = $this->selectController($pageName);
		$controller->index();
	}

	//--------------------------is functions--------------------------------

	private function isAllowed(){
		$allowedArray = [
			'signup',
			'login',
			'welcome',
			'password',
			'mailnotification',
		];

		foreach($allowedArray as $allowed){
			if($this->url[0]==$allowed){
				return true;
			}
		}
		return false;
	}
	
}
?>