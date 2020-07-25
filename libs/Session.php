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
			$cryptography = new Cryptography();
			$encrypted_value = $cryptography->encrypt($value);
			$_SESSION[$key] = $encrypted_value;
		}

		public static function get($key){
			$cryptography = new Cryptography();
			$decrypted_value = $cryptography->decrypt($_SESSION[$key]);
			return $decrypted_value;
		} 

		public static function has($key){
			return isset($_SESSION[$key]) ? true : false;
		} 
		
		public static function destroy(){
			//unset($_SESSION);
			session_destroy();
		}
	}

 ?>