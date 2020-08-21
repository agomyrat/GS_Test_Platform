<?php

    class Main extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "main";

	}

	public function index(){
		$user_name = $this->model->getUsername($this->getUserId());
		$this->view->render('main/index' , [
			'username' => $user_name
		]);
	}



}