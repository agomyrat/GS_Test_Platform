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
	require 'libs/Cryptography.php';
	require 'libs/Polyglot.php';

	//configurations
	require 'config/paths.php';
	require 'config/database.php';
	require 'config/cookie_session.php';
	require 'config/cryptography.php';

	//models
	require 'models/user_model.php';
	require 'models/test_model.php';
	require 'models/question_model.php';

	$app = new Bootstrap();
 ?>