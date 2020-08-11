<?php

    class Mailnotification extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "mail_notification";
	}

	public function index(){
		$this->view->render('mail_notification/index');
	}

}