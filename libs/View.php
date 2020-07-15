<?php 
	class View {
		function __construct(){
			//echo "we are in view<br>";
			$this->msg = "no message";
		}

		public function render($content)
		{	
			require "views/layouts/".$this->layout.".php";
		}
	}

 ?>