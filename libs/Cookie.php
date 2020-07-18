<?php 
	/**
	 * 
	 */
	class Cookie 
	{
/*		public static function set($key,$value){
			 setcookie(USER_ID, $encrypted_user_id , time() + (86400 * 30), "/");
		}
*/
		public static function get($key){
			isset($_COOKIE[$key]) ? $value = $_SESSION[$key] : $value = false;
			return $value;
		} 

        public static function has($key){
			isset($_COOKIE[$key]) ? $value = true : $value = false;
			return $value;
		} 
	}

 ?>