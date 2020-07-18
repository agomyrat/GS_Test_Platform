<?php 
	class View {
		function __construct(){
			//echo "we are in view<br>";
			$this->msg = "no message";
		}

		public function render($content,$elementsArray = null)
		{	
			if(isset($elementsArray)){
				foreach($elementsArray as $key => $value){
					$$key = $value;
				}
			}
			require "views/layouts/".$this->layout.".php";
		}
	}

 ?>