<?php 
	class Bootstrap {
		function __construct(){

		if(isset($_GET['url'])){
			$url = rtrim($_GET['url'], '/');
			$url = explode('/',$url);

			//print_r($url);
			$file = 'controllers/'.$url[0].'.php';
			if(file_exists($file)){
				require $file;
				$controller = new $url[0];
				$controller->loadModel($url[0]);
			}else{
				require 'controllers/fault.php';
				$controller = new Fault;
			}
	
			if(isset($url[1])){
				method_exists($controller,$url[1]) ? $controller->{$url[1]}() : $controller->error();
			}else{
				$controller->index();
			}
		}else{
			require 'controllers/index.php';
			$controller = new index;
			$controller->index();
		}
	}
}
 
?>