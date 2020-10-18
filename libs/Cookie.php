<?php 
	/**
	 * 
	 */
	class Cookie 
	{
		public static function set($key,$value){
			 $encrypted_value = Cryptography::encrypt($value);
			 setcookie($key, $encrypted_value , time() + (86400 * 30), "/");
		}

		public static function get($key){
			$decrypted_value = Cryptography::decrypt($_COOKIE[$key]);
			return $decrypted_value;
		} 

        public static function has($key){
			return isset($_COOKIE[$key]) ? true : false;
		} 

		public static function isNumber($key){
			return isset($_COOKIE[$key]) ? is_numeric(Cookie::get($key)) : false;
		} 

		public static function destroy($key= null){
			if(!empty($key)){
				echo 'girdi'.$key;
				setcookie($key, "", time() - 3600);
				return;
			}
			//destroy all cookie
			foreach($_COOKIE as $cookie){
				setcookie($cookie, "", time() - 3600);
			}
		}

	}
 ?>