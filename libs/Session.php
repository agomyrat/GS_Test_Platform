<?php 
	/**
	 * 
	 */
	class Session 
	{
		
		public static function init()
		{
			session_start();
		}

		public static function set($key,$value){

			$_SESSION[$key] = $value;
		}

		public static function get($key){
			isset($_SESSION[$key]) ? $value = $_SESSION[$key] : $value = false;
			return $value;
		} 

		public static function has($key){
			isset($_SESSION[$key]) ? $value = true : $value = false;
			return $value;
		} 
		
		public static function destroy(){
			//unset($_SESSION);
			session_destroy();
		}
	}

 ?>