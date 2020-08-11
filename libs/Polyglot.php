<?php 
	/**
	 * 
	 */
	class Polyglot
	{
		public static $page;
        public static function translate($key){
			return Session::has(LANG) ? self::$page[$key][Session::get(LANG)] : self::$page[$key]['EN'];
        }

		public static function setPage($page){	
			self::$page = require "lang/".$page.".php";
		}
	}

 ?>