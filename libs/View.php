<?php 
	class View {
		function __construct(){
			//echo "we are in view<br>";
			$this->msg = "no message";
		}

		public function render($content,$elementsArray = null)
		{	
			$asset_array = $this->findFile($content);

			if(isset($elementsArray)){
				foreach($elementsArray as $key => $value){
					$$key = $value;
				}
			}
			
			echo '<link rel="icon" href="'.URL.'source/general/img/Logo-orange.svg">';
			require "views/layouts/".$this->layout.".php";
		}

		public function findFile($name){
			$messy_asset = explode('/', rtrim($name, '/') );
			$asset = $messy_asset[0];

			$asset_file = 'assets/'.$asset.'.php';
			return file_exists($asset_file) ? require $asset_file : null;
		}
	}

 ?>