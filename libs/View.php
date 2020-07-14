<?php 
	class View {
		function __construct(){
			//echo "we are in view<br>";
			$this->msg = "no message";
		}

		public function render($layout,$name)
		{	
			//require 'views/header.php';
			//$content = "require 'views/'.$name.'.php'";
			//require 'views/footer.php';
			require "views/layouts/".$layout.".php";
		}
	}

 ?>