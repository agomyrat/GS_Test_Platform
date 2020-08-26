<?php 
	class View {

		public function render($content,$elementsArray = null)
		{	
			$this->pageName = $this->pageName($content);
			$asset_array = $this->findFile($content);

			if(isset($elementsArray)){
				foreach($elementsArray as $key => $value){
					$$key = $value;
				}
			}
			
			//echo '<link rel="icon" href="'.URL.'source/general/img/Logo-orange.svg">';
			require "views/layouts/".$this->layout.".php";
		}

		public static function getHtmlTemplate($name,$elementsArray = null){
			if(!empty($elementsArray)){
				foreach($elementsArray as $key => $value){
					$$key = $value;
				}
			}
			$path = "views/mail/html/".$name.".php";
			return file_exists($path) ? require $path : null;
		}

		public static function getTextTemplate($name,$elementsArray = null){
			if(!empty($elementsArray)){
				foreach($elementsArray as $key => $value){
					$$key = $value;
				}
			}

			$path = "views/mail/text/".$name.".php";
			return file_exists($path) ? require $path : null;
		}

		public function findFile($name){
			$asset_file = 'assets/'.$this->pageName.'.php';
			return file_exists($asset_file) ? require $asset_file : null;
		}

		public function pageName($content){
			$messy_asset = explode('/', rtrim($content, '/') );
			return $messy_asset[0];
		}

		public function renderCard($card, $count){
			 for($i=0;$i<$count;$i++):
				require "views/".$this->pageName."/".$card.".php";
			 endfor;
		}
	}

 ?>