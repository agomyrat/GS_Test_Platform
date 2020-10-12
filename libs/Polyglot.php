<?php

/**
 * 
 */
class Polyglot
{
	public static $page;
	public static function translate($key)
	{
		if (Session::has(LANG)) {
			return isset(self::$page[$key][Session::get(LANG)]) ? self::$page[$key][Session::get(LANG)] : '[____]';
		} else {
			return isset(self::$page[$key]['EN']) ? self::$page[$key]['EN'] : '[____]';
		}
	}

	public static function setPage($page)
	{
		if (file_exists("lang/" . $page . ".php")) {
			self::$page = require "lang/" . $page . ".php";
		}
	}

	public static function extendPage($page)
	{
		if (empty(self::$page)) {
			self::setPage($page);
		}else if (file_exists("lang/" . $page . ".php")){
			self::$page = array_merge(self::$page,require "lang/" . $page . ".php");
		}
	}

	public static function changeLanguage()
	{
		if (isset($_POST['language'])) {
			Session::set(LANG, $_POST['language']);
		} else {
			echo "Error : Language couldn't change";
		}
	}

	//--- test 
	public static function forJS()
	{

		return json_encode(self::$page);
	}
}
