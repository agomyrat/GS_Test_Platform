<?php 
	
	//use autoloader
	require 'libs/Bootstrap.php';
	require 'libs/Controller.php';
	require 'libs/View.php';
	require 'libs/Model.php';

	//Library
	require 'libs/Database.php';
	require 'libs/Session.php';

	require 'config/paths.php';
	require 'config/database.php';

	$_POST['hello']='hi';
	$app = new Bootstrap();

 ?>