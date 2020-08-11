<?php

    class Newpassword extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "new_password";
	}

	public function index(){
		$this->view->render('new_password/index');
	}

}