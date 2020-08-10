<?php 
	/**
	 * 
	 */
	class Polyglot
	{
		public static $page;
        public static function translate($key){
            $language = Session::get(LANG);
			return self::$page[$key][$language];
        }

		public static function setPage($page){	
			self::$page = require "lang/".$page.".php";
		}
	}

 ?>