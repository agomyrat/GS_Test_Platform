<?php 
	/**
	 * 
	 */
	class Polyglot
	{
		public static $page;
        public static function translate($key){
			if(Cookie::has(LANG)){
				return isset($key) ? self::$page[$key][Cookie::get(LANG)] : '[____]';
			}else{
				return isset($key) ? self::$page[$key]['EN'] : '[____]';
			}
        }

		public static function setPage($page){	
			self::$page = require "lang/".$page.".php";
		}

		public static function changeLanguage(){
			if(isset($_POST['language'])){
				Cookie::set(LANG,$_POST['language']);
			}else{
				echo "Error : Language couldn't change";
			}
		}
	}

 ?>