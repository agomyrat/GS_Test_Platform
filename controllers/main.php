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
			$test_cards = _Test::getRecentTests(3);
			$this->view->render('main/index' , [
				'username' => $user_name,
				'test_cards' => $test_cards
			]);
		}

		public function myTests(){
			$this->view->render('my_tests/index');
		}

		public function getTestCards(){
			//print_r($_POST);die;
			if(!empty($_POST)){
				$type = isset($_POST['type']) && !empty($_POST['type']) ? strtolower($_POST['type']): 'recent added';
				$start = $_POST['amount'];
				$search = isset($_POST['search']) ? $_POST['search'] : '';
				//echo $search;
				if($type=='popular tests'){
					$test_cards = _Test::getPopularTests($start,10,$search);	
				}
				if($type=='recent added'){
					$test_cards = _Test::getRecentTests($start,10,$search);	
				}
				if($type=='top tests'){
					$test_cards = _Test::getTopTests($start,10,$search);
				}
				if($type=='pinned tests'){
					$test_cards = _Test::getMyPinnedTests(Session::get(USER_ID),$start,10,$search);
				}
				if($type=='my tests'){
					$test_cards = _Test::getMyTests(Session::get(USER_ID),$start,10,$search);
				}

				//$response['test_data'] = $test_cards;
				//print_r($test_cards);die;
				if(empty($test_cards)){
					echo 0;
				}else{
					echo json_encode($test_cards);	
				}
			}
		}

	}