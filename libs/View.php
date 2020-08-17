<?php 
	class View {
		function __construct(){
			//echo "we are in view<br>";
			$this->msg = "no message";
		}

		public function render($content,$elementsArray = null)
		{	
			$messy_asset = explode('/', rtrim($content, '/') );
			$asset = $messy_asset[0];

			$asset_file = 'assets/'.$asset.'.php';
			$asset_array = file_exists($asset_file) ? require $asset_file : null;

			if(isset($elementsArray)){
				foreach($elementsArray as $key => $value){
					$$key = $value;
				}
			}
			echo '<link rel="icon" href="source/general/img/Logo-orange.svg">';
			require "views/layouts/".$this->layout.".php";
		}
	}

 ?>