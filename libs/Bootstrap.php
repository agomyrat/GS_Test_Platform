<?php 
	class Bootstrap {
		function __construct(){
		
		Session::init();
		$this->url = $this->getUrl();
		//print_r($_SESSION);

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
 

 
		// if(Session::has(USER_ID) || Cookie::has(USER_ID)){

		// 	if(isset($_GET['url'])){
		// 	$url = rtrim($_GET['url'], '/');
		// 	$url = explode('/',$url);

		// 	//choose the right controller
		// 	$file = 'controllers/'.$url[0].'.php';
		// 	if(file_exists($file)){
		// 		require $file;
		// 		$controller = new $url[0];
		// 		$controller->loadModel($url[0]);
		// 	}else{
		// 		require 'controllers/error.php';
		// 		$controller = new Error;
		// 	}
		// 	//----------------------------

	
		// 	//choose the right method from chosen controller
		// 	if(isset($url[1])){

		// 		if(method_exists($controller,$url[1])){
		// 			if(isset($url[2])){
		// 				$controller->{$url[1]}($url[2]);
		// 			}else{
		// 				$controller->{$url[1]}();
		// 			}
		// 		}else{
		// 			$controller->error();
		// 		}
		// 	}else{
		// 		$controller->index();
		// 	}
		// 	//-----------------------------------------------	


		// //choose and run index method of index controller if no controller was chosen
		// 	}else if(Cookie::has(USER_ID) || Session::has(USER_ID)){
		// 		require 'controllers/main.php';
		// 		$controller = new main;
		// 		$controller->index();
		// 	}else{
		// 		require 'controllers/welcome.php';
		// 		$controller = new welcome;
		// 		$controller->index();
		// 	}			
			
		// //-----------------------------------------------------------------
		// }else if(isset($_GET['url'])){
		// 	$url = rtrim($_GET['url'], '/');
		// 	$url = explode('/',$url);

		// 	if($url[0]=='signup' || $url[0]=='login' || $url[0]=='welcome'){
		// 		//choose the right controller
		// 	$file = 'controllers/'.$url[0].'.php';
		// 	if(file_exists($file)){
		// 		require $file;
		// 		$controller = new $url[0];
		// 		$controller->loadModel($url[0]);
		// 	}else{
		// 		require 'controllers/error.php';
		// 		$controller = new Error;
		// 	}
		// 	//----------------------------

	
		// 	//choose the right method from chosen controller
		// 	if(isset($url[1])){

		// 		if(method_exists($controller,$url[1])){
		// 			if(isset($url[2])){
		// 				$controller->{$url[1]}($url[2]);
		// 			}else{
		// 				$controller->{$url[1]}();
		// 			}
		// 		}else{
		// 			$controller->error();
		// 		}
		// 	}else{
		// 		$controller->index();
		// 	}
		// 	//-----------------------------------------------	
		// 	}else{
		// 		require 'controllers/welcome.php';
		// 		$controller = new welcome;
		// 		$controller->index();
		// 	}
		// }else{
		// 	require 'controllers/welcome.php';
		// 	$controller = new welcome;
		// 	$controller->index();
		// }
?>