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
			$encrypted_value = Cryptography::encrypt($value);
			$_SESSION[$key] = $encrypted_value;
		}

		public static function get($key){
			$decrypted_value = Cryptography::decrypt($_SESSION[$key]);
			return $decrypted_value;
		} 

		public static function has($key){
			return isset($_SESSION[$key]);
		} 

		public static function isNumber($key){
			return isset($_SESSION[$key]) ? is_numeric(Session::get($key)) : false;
		} 
		
		public static function destroy(){
			//unset($_SESSION);
			session_destroy();
		}


	}

 ?>