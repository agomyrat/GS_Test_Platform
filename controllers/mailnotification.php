<?php

    class Mailnotification extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        	$this->view->layout = "logo";
	}

	public function index(){
		Polyglot::setPage('mail_notification');
		$this->view->render('mail_notification/index');
	}

}