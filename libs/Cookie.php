<?php 
	/**
	 * 
	 */
	class Cookie 
	{
		public static function set($key,$value){
			 $cryptography = new Cryptography();
			 $encrypted_value = $cryptography->encrypt($value);
			 setcookie($key, $encrypted_value , time() + (86400 * 30), "/");
		}

		public static function get($key){
			$cryptography = new Cryptography();
			$decrypted_value = $cryptography->decrypt($_COOKIE[$key]);
			return $decrypted_value;
		} 

        public static function has($key){
			return isset($_COOKIE[$key]) ? true : false;;
		} 
	}

 ?>