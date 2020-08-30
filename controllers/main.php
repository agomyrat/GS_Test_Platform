<?php

    class Main extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "main";

	}

	public function index(){
		$user_name = $this->user->data['USER_NAME'];
		$this->view->render('main/index' , [
			'username' => $user_name
		]);
	}



}