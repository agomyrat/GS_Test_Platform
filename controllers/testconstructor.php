<?php

    class TestConstructor extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        //$this->view->layout = "mail_notification";
	}

	public function index(){
		// Polyglot::setPage('mail_notification');
		// $this->view->render('mail_notification/index');
	}

}