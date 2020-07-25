<?php 

	
	//use autoloader
	//Library
	require 'libs/Bootstrap.php';
	require 'libs/Controller.php';
	require 'libs/View.php';
	require 'libs/Model.php';	
	require 'libs/Database.php';
	require 'libs/Session.php';
	require 'libs/Cookie.php';

	//configurations
	require 'config/paths.php';
	require 'config/database.php';
	require 'config/cookie.php';
	require 'config/cryptography.php';

	$app = new Bootstrap();
 ?>