<?php

    class Forgotpassword extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "icon_navbar";
	}

	public function index(){
		Polyglot::setPage('forgot_password');
		$this->view->render('forgot_password/index');
	}



}