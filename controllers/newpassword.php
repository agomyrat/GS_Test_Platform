<?php

    class Newpassword extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        	$this->view->layout = "logo";
	}

	public function index(){
		Polyglot::setPage('new_password');
		$this->view->render('new_password/index');
	}

}