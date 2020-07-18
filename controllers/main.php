<?php

    class Main extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "main";

	}

	public function index(){
		$user_name = $this->model->getUsername(Session::get(USER_ID));
		$this->view->render('main/index' , [
			'username' => $user_name
		]);
	}



}