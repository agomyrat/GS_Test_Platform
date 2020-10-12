<?php

class Main extends Controller
{

	function __construct()
	{
		parent::__construct();
		$this->view->layout = "main";
	}

	public function index()
	{
		Polyglot::setPage('main');
		Polyglot::extendPage('navbar');

		$user_name = $this->user->data['USER_NAME'];
		$test_cards = _Test::getRecentTests(3);
		$this->view->render('main/index', [
			'username' => $user_name,
			'test_cards' => $test_cards
		]);
	}

	public function myTests()
	{	
		Polyglot::setPage('navbar');
		$this->view->render('my_tests/index');
	}

	public function getTestCards()
	{
		//print_r($_POST);die;
		if (!empty($_POST)) {
			$type = isset($_POST['type']) && !empty($_POST['type']) ? strtolower($_POST['type']) : 'recent added';
			$start = isset($_POST['amount']) ? $_POST['amount'] : 0;
			$search = isset($_POST['search']) ? $_POST['search'] : '';
			$lang = Session::get(LANG);
			//echo $search;
			if ($type == 'popular tests') {
				$test_cards = _Test::getPopularTests($start, 12, $search);
			}
			if ($type == 'recent added') {
				$test_cards = _Test::getRecentTests($start, 12, $search);
			}
			if ($type == 'top tests') {
				$test_cards = _Test::getTopTests($start, 12, $search);
			}
			if ($type == 'pinned tests') {
				$test_cards = _Test::getMyPinnedTests(Session::get(USER_ID), $start, 12, $search);
			}
			if ($type == 'mytests') {
				$test_cards = _Test::getMyTests(Session::get(USER_ID), $start, 20, $search);
			}
			if ($type == 'history') {
				$test_cards = _Test::getMyHistory(Session::get(USER_ID), $start,10,$search);
			}
			if ($type == 'private') {
				$test_cards = _Test::getMyPrivateTests(Session::get(USER_ID), $start,10,$search);
			}
			if ($type == 'public') {
				$test_cards = _Test::getMyPublicTests(Session::get(USER_ID), $start,10,$search);
			}
			if ($type == 'waiting') {
				$test_cards = _Test::getMyWaitingTests(Session::get(USER_ID), $start,10,$search);
			}
			if ($type == 'archive') {
				$test_cards = _Test::getMyArchiveTests(Session::get(USER_ID), $start,10,$search);
			}

			//$response['test_data'] = $test_cards;
			//print_r($test_cards);die;
			if (empty($test_cards)) {
				echo 0;
			} else {
				echo json_encode($test_cards);
			}
		}
	}
}
