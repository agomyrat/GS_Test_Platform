<?php

    class Forgotpassword extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->view->layout = "logo";
	}

	public function index(){
		Polyglot::setPage('forgot_password');
		$this->view->render('forgot_password/index');
	}



}