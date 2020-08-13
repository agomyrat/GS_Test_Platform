<?php

    class Forgotpassword extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "forgot_password";
	}

	public function index(){
		Polyglot::setPage('forgot_password');
		$this->view->render('forgot_password/index');
	}



}