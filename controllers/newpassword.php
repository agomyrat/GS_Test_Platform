<?php

    class Newpassword extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "new_password";
	}

	public function index(){
		Polyglot::setPage('new_password');
		$this->view->render('new_password/index');
	}

}